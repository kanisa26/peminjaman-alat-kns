<?php

namespace App\Services;

use App\Models\Alat;
use Illuminate\Support\Facades\Session;

class Keranjang
{
    private const KUNCI_SESSION = 'keranjang';

    public function isiMentah(): array
    {
        return Session::get(self::KUNCI_SESSION, []);
    }

    public function isi()
    {
        $isiMentah = $this->isiMentah();

        if (empty($isiMentah)) {
            return collect();
        }

        $daftarAlat = Alat::with('kategori')
            ->whereIn('id', array_keys($isiMentah))
            ->get();

        return $daftarAlat->map(function ($alat) use ($isiMentah) {
            return (object) [
                'alat' => $alat,
                'jumlah' => (int) ($isiMentah[$alat->id] ?? 0),
            ];
        });
    }

    public function tambah(Alat $alat, int $jumlah): void
    {
        $isiMentah = $this->isiMentah();

        $jumlahLama = (int) ($isiMentah[$alat->id] ?? 0);

        $jumlahBaru = $jumlahLama + $jumlah;

        if ($jumlahBaru > $alat->stok_tersedia) {
            $jumlahBaru = $alat->stok_tersedia;
        }

        $isiMentah[$alat->id] = $jumlahBaru;

        Session::put(self::KUNCI_SESSION, $isiMentah);
        Session::save();
    }

    public function ubahJumlah(Alat $alat, int $jumlah): void
    {
        $isiMentah = $this->isiMentah();

        if (!isset($isiMentah[$alat->id])) {
            return;
        }

        $jumlah = min($jumlah, $alat->stok_tersedia);

        $isiMentah[$alat->id] = (int) $jumlah;

        Session::put(self::KUNCI_SESSION, $isiMentah);
        Session::save();
    }

    public function hapus(int $alatId): void
    {
        $isiMentah = $this->isiMentah();

        unset($isiMentah[$alatId]);

        Session::put(self::KUNCI_SESSION, $isiMentah);
        Session::save();
    }

    public function kosongkan(): void
    {
        Session::forget(self::KUNCI_SESSION);
        Session::save();
    }

    public function jumlahBaris(): int
    {
        return count($this->isiMentah());
    }

    public function kosong(): bool
    {
        return $this->jumlahBaris() === 0;
    }
}