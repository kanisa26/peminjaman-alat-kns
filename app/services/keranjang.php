<?php

namespace App\Services;

use App\Models\Alat;
use App\Models\Keranjang as ModelKeranjang;

class Keranjang
{
    public function isiMentah(): array
    {
        if (!auth()->check()) {
            return [];
        }

        return ModelKeranjang::where('user_id', auth()->id())
            ->pluck('jumlah', 'alat_id')
            ->toArray();
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
        if (!auth()->check()) {
            return;
        }

        $keranjang = ModelKeranjang::firstOrNew([
            'user_id' => auth()->id(),
            'alat_id' => $alat->id,
        ]);

        $jumlahLama = (int) ($keranjang->jumlah ?? 0);
        $jumlahBaru = $jumlahLama + $jumlah;

        if ($jumlahBaru > $alat->stok_tersedia) {
            $jumlahBaru = $alat->stok_tersedia;
        }

        $keranjang->jumlah = $jumlahBaru;
        $keranjang->save();
    }

    public function ubahJumlah(Alat $alat, int $jumlah): void
    {
        if (!auth()->check()) {
            return;
        }

        $keranjang = ModelKeranjang::where('user_id', auth()->id())
            ->where('alat_id', $alat->id)
            ->first();

        if (!$keranjang) {
            return;
        }

        $jumlah = min($jumlah, $alat->stok_tersedia);

        $keranjang->jumlah = (int) $jumlah;
        $keranjang->save();
    }

    public function hapus(int $alatId): void
    {
        if (!auth()->check()) {
            return;
        }

        ModelKeranjang::where('user_id', auth()->id())
            ->where('alat_id', $alatId)
            ->delete();
    }

    public function kosongkan(): void
    {
        if (!auth()->check()) {
            return;
        }

        ModelKeranjang::where('user_id', auth()->id())
            ->delete();
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