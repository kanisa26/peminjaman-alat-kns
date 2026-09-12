<?php

namespace App\Services;

use App\Enums\StatusPeminjaman;
use App\Models\Peminjaman;
use App\Models\Pengaturan;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use App\Models\LogAktivitas;
use App\Models\Pengembalian;

class PeminjamanService
{
    public function __construct(private Keranjang $keranjang)
    {
    }

    public function daftarTunggakan(User $peminjam)
    {
        return Peminjaman::where('user_id', $peminjam->id)
            ->whereIn('status', [
                StatusPeminjaman::Dipinjam->value,
                StatusPeminjaman::MenungguVerifikasi->value,
            ])
            ->whereDate('tgl_harus_kembali', '<', now()->toDateString())
            ->get();
    }

    public function buatPengajuan(
        User $peminjam,
        array $data
    ): Peminjaman {
        $isiKeranjang = $this->keranjang->isi();

        if ($isiKeranjang->isEmpty()) {
            throw ValidationException::withMessages([
                'keranjang' => 'Keranjang masih kosong.',
            ]);
        }

        if ($this->daftarTunggakan($peminjam)->isNotEmpty()) {
            throw ValidationException::withMessages([
                'keranjang' => 'Anda masih memiliki peminjaman yang lewat tenggat.',
            ]);
        }

        return DB::transaction(function () use (
            $peminjam,
            $data,
            $isiKeranjang
        ) {
            $peminjaman = Peminjaman::create([
                'kode_pinjam' => $this->buatKodePinjam($data['tgl_pinjam']),
                'user_id' => $peminjam->id,
                'tgl_pinjam' => $data['tgl_pinjam'],
                'tgl_harus_kembali' => $data['tgl_harus_kembali'],
                'status' => StatusPeminjaman::Diajukan,
                'keperluan' => $data['keperluan'] ?? null,
            ]);

            foreach ($isiKeranjang as $baris) {
                $peminjaman->detail()->create([
                    'alat_id' => $baris->alat->id,
                    'jumlah' => $baris->jumlah,
                ]);
            }

            LogAktivitas::create([
    'user_id' => $peminjam->id,
    'aksi' => 'ajukan',
    'tabel_tujuan' => 'peminjaman',
    'deskripsi' => 'Mengajukan peminjaman ' . $peminjaman->kode_pinjam,
    'ip_address' => request()->ip(),
]);

            $this->keranjang->kosongkan();

            return $peminjaman;
        });
    }

    public function setujui(
        Peminjaman $peminjaman,
        int $petugasId,
        ?string $tenggatBaru = null
    ): void {
        abort_unless(
            $peminjaman->status->bolehKe(StatusPeminjaman::Dipinjam),
            422,
            'Status peminjaman tidak memungkinkan untuk disetujui.'
        );

        DB::beginTransaction();

        try {
            // petugas boleh menyesuaikan tenggat setelah menyetujui
            if (
                $tenggatBaru &&
                $tenggatBaru !== $peminjaman->tgl_harus_kembali->toDateString()
            ) {
                $tenggatLama = $peminjaman->tgl_harus_kembali->toDateString();

                $peminjaman->update([
                    'tgl_harus_kembali' => $tenggatBaru
                ]);

                LogAktivitas::create([
                    'user_id' => $petugasId,
                    'aksi' => 'ubah_tenggat',
                    'tabel_tujuan' => 'peminjaman',
                    'deskripsi' => 'Tenggat ' . $peminjaman->kode_pinjam
                        . ' diubah dari ' . $tenggatLama
                        . ' menjadi ' . $tenggatBaru,
                    'ip_address' => request()->ip(),
                ]);
            }

            DB::statement('CALL sp_setujui_peminjaman(?, ?)', [
                $peminjaman->id,
                $petugasId,
            ]);

            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
    }

    public function tolak(
        Peminjaman $peminjaman,
        int $petugasId,
        string $alasan
    ): void {
        abort_unless(
            $peminjaman->status->bolehKe(StatusPeminjaman::Ditolak),
            422,
            'Status peminjaman tidak memungkinkan untuk ditolak.'
        );

        DB::transaction(function () use (
            $peminjaman,
            $petugasId,
            $alasan
        ) {
            $peminjaman->update([
                'status' => StatusPeminjaman::Ditolak,
                'petugas_id' => $petugasId,
                'alasan_tolak' => $alasan,
            ]);

            LogAktivitas::create([
                'user_id' => $petugasId,
                'aksi' => 'tolak',
                'tabel_tujuan' => 'peminjaman',
                'deskripsi' => 'Menolak peminjaman ' . $peminjaman->kode_pinjam,
                'ip_address' => request()->ip(),
            ]);
        });
    }

    public function antrianPengajuan()
    {
        return Peminjaman::with(['peminjam', 'detail.alat'])
            ->where('status', StatusPeminjaman::Diajukan->value)
            ->orderBy('created_at')
            ->paginate(10);
    }

    private function buatKodePinjam(string $tanggal): string
    {
        $awalan = 'PJM-' . date('Ymd', strtotime($tanggal)) . '-';

        $kodeTerakhir = Peminjaman::where('kode_pinjam', 'like', $awalan . '%')
            ->orderByDesc('kode_pinjam')
            ->lockForUpdate()
            ->value('kode_pinjam');

        $nomorUrut = $kodeTerakhir
            ? ((int) substr($kodeTerakhir, -3) + 1)
            : 1;

        return $awalan . str_pad($nomorUrut, 3, '0', STR_PAD_LEFT);
    }

    public function maksHariPinjam(): int
    {
        return (int) Pengaturan::ambil('maks_hari_pinjam', 30);
    }

    public function defaultHariPinjam(): int
    {
        return (int) Pengaturan::ambil('default_hari_pinjam', 7);
    }

    public function ajukanPengembalian(
    Peminjaman $peminjaman
): void {
    abort_unless(
        $peminjaman->status === StatusPeminjaman::Dipinjam,
        422,
        'Peminjaman tidak dapat dikembalikan.'
    );

    DB::transaction(function () use ($peminjaman) {

        $peminjaman->update([
            'status' => StatusPeminjaman::MenungguVerifikasi,
            'tgl_diajukan_kembali' => now(),
        ]);

        LogAktivitas::create([
    'user_id' => $peminjaman->user_id,
    'aksi' => 'ajukan_pengembalian',
    'tabel_tujuan' => 'peminjaman',
    'deskripsi' => 'Mengajukan pengembalian ' . $peminjaman->kode_pinjam,
    'ip_address' => request()->ip(),
]);
    });
}
}