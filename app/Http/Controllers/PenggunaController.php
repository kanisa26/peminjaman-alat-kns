<?php

namespace App\Http\Controllers;

use App\Http\Requests\PenggunaRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Models\LogAktivitas;
use Illuminate\Support\Facades\Hash;

class PenggunaController extends Controller
{
    /**
     * Menampilkan daftar pengguna
     *
     * Yang tampil hanya:
     * - pengguna yang sudah disetujui
     * - pengguna aktif
     * - pengguna nonaktif
     *
     * Yang TIDAK tampil:
     * - menunggu validasi
     * - ditolak
     */
    public function index(Request $request)
    {
        $kataKunci = $request->query('cari');
        $peran = $request->query('peran');

        $daftarPengguna = User::with('roles')
            ->where('status_validasi', 'disetujui')
            ->when($kataKunci, function ($query, $kataKunci) {
                $query->where(function ($cabang) use ($kataKunci) {
                    $cabang->where('nama', 'like', '%' . $kataKunci . '%')
                           ->orWhere('username', 'like', '%' . $kataKunci . '%');
                });
            })
            ->when($peran, function ($query, $peran) {
                $query->role($peran);
            })
            ->orderBy('nama')
            ->paginate(10)
            ->withQueryString();

        $daftarPeran = Role::orderBy('name')->get();

        return view('pengguna.index', compact(
            'daftarPengguna',
            'daftarPeran',
            'kataKunci',
            'peran'
        ));
    }


    /**
     * Form tambah pengguna
     */
    public function create()
    {
        $pengguna = new User();

        $daftarPeran = Role::orderBy('name')->get();

        return view('pengguna.form', compact(
            'pengguna',
            'daftarPeran'
        ));
    }


    /**
     * Simpan pengguna baru yang dibuat Admin
     *
     * Admin membuat akun:
     * - Admin     = langsung aktif
     * - Petugas   = langsung aktif
     * - Peminjam  = langsung aktif
     *
     * Jadi tidak masuk antrean validasi.
     */
    public function store(PenggunaRequest $request)
    {
        $data = $request->validated();

        $pengguna = User::create([
            'nama'             => $data['nama'],
            'username'         => $data['username'],
            'email'            => $data['email'] ?? null,
            'no_telp'          => $data['no_telp'] ?? null,
            'password'         => $data['password'],

            // Semua pengguna yang dibuat Admin langsung aktif
            'is_aktif'         => true,
            'status_validasi'  => 'disetujui',
        ]);

        $pengguna->syncRoles([
            $data['peran']
        ]);

        LogAktivitas::create([
            'user_id'       => auth()->id(),
            'aksi'          => 'TAMBAH',
            'tabel_tujuan'  => 'users',
            'deskripsi'     => 'Menambahkan pengguna "' . $pengguna->nama . '". Akun langsung aktif.',
            'ip_address'    => request()->ip(),
        ]);

        return redirect()
            ->route('pengguna.index')
            ->with(
                'sukses',
                'Pengguna berhasil ditambahkan dan langsung aktif.'
            );
    }


    /**
     * Detail pengguna
     */
    public function show(User $user)
    {
        //
    }


    /**
     * Form edit pengguna
     */
    public function edit(User $pengguna)
    {
        $daftarPeran = Role::orderBy('name')->get();

        return view('pengguna.form', compact(
            'pengguna',
            'daftarPeran'
        ));
    }


    /**
     * Update pengguna
     */
    public function update(
        PenggunaRequest $request,
        User $pengguna
    ) {
        $data = $request->validated();

        /*
         * Admin tidak boleh menonaktifkan dirinya sendiri
         */
        if ($this->diriSendiri($pengguna) && !$data['is_aktif']) {
            return back()
                ->with('gagal', 'Anda tidak dapat menonaktifkan akun Anda sendiri.');
        }

        $pengguna->nama = $data['nama'];
        $pengguna->username = $data['username'];
        $pengguna->email = $data['email'] ?? null;
        $pengguna->no_telp = $data['no_telp'] ?? null;

        /*
         * Status aktif/nonaktif hanya berdasarkan is_aktif.
         *
         * Jangan ubah menjadi "ditolak" ketika akun dinonaktifkan.
         *
         * Karena:
         * disetujui + is_aktif=false
         * = pengguna NONAKTIF
         */
        $pengguna->is_aktif = $data['is_aktif'];

        /*
         * Kalau pengguna diaktifkan kembali,
         * pastikan status validasinya tetap disetujui.
         */
        if ($pengguna->is_aktif) {
            $pengguna->status_validasi = 'disetujui';
        }

        if (!empty($data['password'])) {
            $pengguna->password = $data['password'];
        }

        $pengguna->save();

        $pengguna->syncRoles([
            $data['peran']
        ]);

        LogAktivitas::create([
            'user_id'       => auth()->id(),
            'aksi'          => 'UBAH',
            'tabel_tujuan'  => 'users',
            'deskripsi'     => 'Mengubah data pengguna "' . $pengguna->nama . '".',
            'ip_address'    => request()->ip(),
        ]);

        return redirect()
            ->route('pengguna.index')
            ->with(
                'sukses',
                'Data pengguna berhasil diperbarui.'
            );
    }


    /**
     * Validasi pengguna dari Dashboard Admin
     */
    public function validasi(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $pengguna = User::with('roles')
            ->findOrFail($request->user_id);

        /*
         * Admin tidak perlu validasi.
         */
        if ($pengguna->hasRole('admin')) {
            return back()
                ->with(
                    'gagal',
                    'Akun Admin tidak memerlukan validasi.'
                );
        }

        /*
         * Hanya akun yang benar-benar menunggu
         * yang boleh divalidasi.
         */
        if ($pengguna->status_validasi !== 'menunggu') {
            return back()
                ->with(
                    'gagal',
                    'Pengguna tersebut tidak sedang menunggu validasi.'
                );
        }

        /*
         * Setujui pengguna
         */
        $pengguna->is_aktif = true;
        $pengguna->status_validasi = 'disetujui';
        $pengguna->alasan_penolakan = null;
        $pengguna->save();

        LogAktivitas::create([
            'user_id'       => auth()->id(),
            'aksi'          => 'VALIDASI',
            'tabel_tujuan'  => 'users',
            'deskripsi'     => 'Memvalidasi pengguna "' . $pengguna->nama . '".',
            'ip_address'    => request()->ip(),
        ]);

        return redirect()
            ->back()
            ->with(
                'sukses',
                'Pengguna "' . $pengguna->nama . '" berhasil divalidasi dan sekarang masuk ke halaman Pengguna.'
            );
    }


    /**
     * Menolak pengguna dari Dashboard Admin
     */
    public function tolak(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'alasan_penolakan' => 'required|string|max:1000',
        ], [
            'alasan_penolakan.required' =>
                'Alasan penolakan wajib diisi.',
        ]);

        $pengguna = User::findOrFail(
            $request->user_id
        );

        /*
         * Hanya pengguna yang sedang menunggu
         * yang boleh ditolak.
         */
        if ($pengguna->status_validasi !== 'menunggu') {
            return back()
                ->with(
                    'gagal',
                    'Pengguna tersebut tidak sedang menunggu validasi.'
                );
        }

        $nama = $pengguna->nama;

        /*
         * Tandai sebagai ditolak
         */
        $pengguna->is_aktif = false;
        $pengguna->status_validasi = 'ditolak';
        $pengguna->alasan_penolakan =
            $request->alasan_penolakan;

        $pengguna->save();

        LogAktivitas::create([
            'user_id' => auth()->id(),
            'aksi' => 'TOLAK',
            'tabel_tujuan' => 'users',
            'deskripsi' =>
                'Menolak pengguna "' .
                $nama .
                '". Alasan: ' .
                $request->alasan_penolakan,
            'ip_address' => $request->ip(),
        ]);

        return redirect()
            ->route('admin.dasbor')
            ->with(
                'sukses',
                'Pengguna "' .
                $nama .
                '" berhasil ditolak.'
            );
    }


    /**
     * Pendaftaran umum
     *
     * Catatan:
     * Route register kamu sekarang menggunakan AuthController,
     * jadi method ini tidak dipakai oleh route tersebut.
     */
    public function daftar()
    {
        return view('auth.register');
    }


    /**
     * Pendaftaran umum versi lama
     */
    public function daftarStore(Request $request)
    {
        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users,username',
            'email' => 'required|email|max:255|unique:users,email',
            'no_telp' => 'nullable|string|max:20',
            'password' => 'required|min:6|confirmed',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.unique' => 'Username sudah digunakan.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah digunakan.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $pengguna = User::create([
            'nama' => $data['nama'],
            'username' => $data['username'],
            'email' => $data['email'],
            'no_telp' => $data['no_telp'] ?? null,
            'password' => Hash::make($data['password']),
            'is_aktif' => false,
            'status_validasi' => 'menunggu',
        ]);

        $pengguna->syncRoles([
            'peminjam'
        ]);

        LogAktivitas::create([
            'user_id' => $pengguna->id,
            'aksi' => 'DAFTAR',
            'tabel_tujuan' => 'users',
            'deskripsi' =>
                'Pengguna "' .
                $pengguna->nama .
                '" melakukan pendaftaran akun dan menunggu validasi Admin.',
            'ip_address' => $request->ip(),
        ]);

        return redirect()
            ->route('login')
            ->with(
                'sukses',
                'Pendaftaran berhasil! Akun Anda sedang menunggu validasi Admin.'
            );
    }


    /**
     * Hapus pengguna
     */
    public function destroy(User $pengguna)
    {
        if ($this->diriSendiri($pengguna)) {
            return redirect()
                ->route('pengguna.index')
                ->with(
                    'gagal',
                    'Anda tidak dapat menghapus akun Anda sendiri.'
                );
        }

        if ($pengguna->peminjamanDiajukan()->exists()) {
            return redirect()
                ->route('pengguna.index')
                ->with(
                    'gagal',
                    'Pengguna tidak dapat dihapus karena memiliki riwayat peminjaman. Nonaktifkan akunnya sebagai gantinya.'
                );
        }

        $pengguna->delete();

        return redirect()
            ->route('pengguna.index')
            ->with(
                'sukses',
                'Pengguna berhasil dihapus.'
            );
    }


    /**
     * Cek apakah pengguna adalah diri sendiri
     */
    private function diriSendiri(User $pengguna): bool
    {
        return $pengguna->id === auth()->id();
    }
}