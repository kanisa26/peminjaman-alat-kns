<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pengaturan;

class PengaturanSeeder extends Seeder
{
    public function run(): void
    {
        $daftarPengaturan = [
            ['kunci' => 'nama_sekolah', 'nilai' => 'SMK Negeri 1 Padaherang'],
            ['kunci' => 'tarif_denda_harian', 'nilai' => '5000'],
            ['kunci' => 'default_hari_pinjam', 'nilai' => '7'],
            ['kunci' => 'maks_hari_pinjam', 'nilai' => '30'],
        ];

        foreach ($daftarPengaturan as $data) {
            Pengaturan::updateOrCreate(
                ['kunci' => $data['kunci']],
                ['nilai' => $data['nilai']]
            );
        }
    }
}