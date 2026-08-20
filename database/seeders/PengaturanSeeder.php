<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengaturan;

class PengaturanSeeder extends Seeder
{
    public function run(): void
    {
        $daftarPengaturan = [
            ['kunci' => 'tarif_denda_harian', 'nilai' => '5000'],
            ['kunci' => 'durasi_maks_pinjaman', 'nilai' => '7'],
            ['kunci' => 'maks_perpanjangan', 'nilai' => '3'],
            ['kunci' => 'nama_sekolah', 'nilai' => 'SMK Negeri 1 SMKN 1 Padaherang'],
        ];

        foreach ($daftarPengaturan as $data) {
            Pengaturan::firstOrCreate(
                ['kunci' => $data['kunci']],
                ['nilai' => $data['nilai']]
            );
        }
    }
}