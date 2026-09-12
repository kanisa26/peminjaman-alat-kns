<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LogAktivitas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // ==============================
    // HALAMAN SIGN UP
    // ==============================

    public function showRegister()
    {
        return view('auth.register');
    }

    // ==============================
// HALAMAN LOGIN
// ==============================

public function showLogin()
{
    return view('auth.login');
}


// ==============================
// PROSES LOGIN
// ==============================

public function login(Request $request)
{
    $request->validate([
        'username' => 'required|string',
        'password' => 'required|string',
    ], [
        'username.required' => 'Nama pengguna wajib diisi.',
        'password.required' => 'Kata sandi wajib diisi.',
    ]);

    // Cari pengguna berdasarkan username
    $pengguna = User::where('username', $request->username)->first();

    // Username tidak ditemukan
    if (!$pengguna) {
        return back()
            ->with('gagal', 'Nama pengguna atau kata sandi salah.')
            ->withInput($request->only('username'));
    }

    // Password salah
    if (!Hash::check($request->password, $pengguna->password)) {
        return back()
            ->with('gagal', 'Nama pengguna atau kata sandi salah.')
            ->withInput($request->only('username'));
    }

    // ==========================================
    // CEK STATUS VALIDASI
    // ==========================================

    // AKUN DITOLAK
    if ($pengguna->status_validasi === 'ditolak') {

    $alasan = $pengguna->alasan_penolakan
        ?? 'Tidak ada alasan yang diberikan oleh Administrator.';

    return back()
        ->withErrors([
            'login' => 'AKUN DITOLAK|' . $alasan
        ])
        ->withInput($request->only('username'));
}

    // ==========================================
// AKUN MASIH MENUNGGU VALIDASI
// ==========================================

if ($pengguna->status_validasi === 'menunggu') {

    return back()
        ->withErrors([
            'login' => 'Akun Anda masih menunggu validasi Administrator.'
        ])
        ->withInput($request->only('username'));
}


// ==========================================
// AKUN DINONAKTIFKAN OLEH ADMIN
// ==========================================

if (
    $pengguna->status_validasi === 'disetujui'
    && !$pengguna->is_aktif
) {

    return back()
        ->withErrors([
            'login' => 'AKUN NONAKTIF|Akun Anda telah dinonaktifkan. Silakan hubungi Administrator.'
        ])
        ->withInput($request->only('username'));
}

    // ==========================================
    // LOGIN
    // ==========================================

    Auth::login($pengguna);

    $request->session()->regenerate();

    // Catat aktivitas login
    LogAktivitas::create([
        'user_id' => $pengguna->id,
        'aksi' => 'LOGIN',
        'tabel_tujuan' => 'users',
        'deskripsi' => 'Pengguna "' . $pengguna->nama . '" berhasil login.',
        'ip_address' => $request->ip(),
    ]);

    // ==========================================
    // REDIRECT SESUAI ROLE
    // ==========================================

    if ($pengguna->hasRole('admin')) {
        return redirect()->route('admin.dasbor');
    }

    if ($pengguna->hasRole('petugas')) {
        return redirect()->route('petugas.dasbor');
    }

    return redirect()->route('peminjam.dasbor');
}


    // ==============================
    // PROSES SIGN UP
    // ==============================

    public function register(Request $request)
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

    // Semua pendaftar dari Sign Up menjadi peminjam
    $pengguna->syncRoles(['peminjam']);

    LogAktivitas::create([
        'user_id' => $pengguna->id,
        'aksi' => 'DAFTAR',
        'tabel_tujuan' => 'users',
        'deskripsi' => 'Pengguna "' . $pengguna->nama . '" melakukan pendaftaran akun dan menunggu validasi Admin.',
        'ip_address' => $request->ip(),
    ]);

    return redirect()
    ->route('register.success', $pengguna->id)
    ->with(
        'sukses',
        'Pendaftaran berhasil! Akun Anda sedang menunggu validasi Admin.'
    );
}


    // ==============================
    // HALAMAN SETELAH REGISTER
    // ==============================

    public function registerSuccess($id)
    {
        $user = User::findOrFail($id);

        return view('auth.register-success', compact('user'));
    }


    // ==============================
    // EDIT DATA REGISTER
    // ==============================

    public function editRegister($id)
    {
        $user = User::findOrFail($id);

        return view('auth.register-edit', compact('user'));
    }


    // ==============================
    // UPDATE DATA REGISTER
    // ==============================

    public function updateRegister(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        $user->update([
            'name' => $request->nama,
            'email' => $request->email,
        ]);

        return redirect()
            ->route('register.success', $user->id)
            ->with('success', 'Data berhasil diperbarui.');
    }
}