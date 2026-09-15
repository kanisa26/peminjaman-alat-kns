<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\User;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\LogAktivitas;
use App\Enums\StatusPeminjaman;
use Carbon\Carbon;

class DasborAdminController extends Controller
{
    public function index()
    {
        $totalAlat = Alat::count();

        $totalPengguna = User::where(
            'status_validasi',
            'disetujui'
        )
        ->where('is_aktif', true)
        ->count();

        $totalPeminjaman = Peminjaman::count();

        $totalPengembalian = Pengembalian::count();


        /*
        |--------------------------------------------------------------------------
        | STATUS PEMINJAMAN
        |--------------------------------------------------------------------------
        */

        $statusDiajukan = Peminjaman::where(
            'status',
            StatusPeminjaman::Diajukan->value
        )->count();

        $statusDipinjam = Peminjaman::where(
            'status',
            StatusPeminjaman::Dipinjam->value
        )->count();

        $statusVerifikasi = Peminjaman::where(
            'status',
            StatusPeminjaman::MenungguVerifikasi->value
        )->count();

        $statusSelesai = Peminjaman::where(
            'status',
            StatusPeminjaman::Selesai->value
        )->count();


        /*
        |--------------------------------------------------------------------------
        | GRAFIK AKTIVITAS PEMINJAMAN BULAN SEBELUMNYA
        |--------------------------------------------------------------------------
        */

        // Mengambil bulan sebelumnya
        $bulanSebelumnya = Carbon::now()->subMonth();

        $awalBulan = $bulanSebelumnya->copy()->startOfMonth();
        $akhirBulan = $bulanSebelumnya->copy()->endOfMonth();

        // Ambil semua peminjaman pada bulan sebelumnya
        $dataPeminjaman = Peminjaman::whereBetween(
            'tgl_pinjam',
            [
                $awalBulan->toDateString(),
                $akhirBulan->toDateString()
            ]
        )
        ->get(['tgl_pinjam']);

        // Kelompokkan berdasarkan tanggal
        $peminjamanPerTanggal = $dataPeminjaman
            ->groupBy(function ($item) {
                return Carbon::parse($item->tgl_pinjam)
                    ->format('Y-m-d');
            });

        $grafikLabel = [];
        $grafikData = [];

        // Buat tanggal dari awal sampai akhir bulan
        $tanggal = $awalBulan->copy();

        while ($tanggal->lte($akhirBulan)) {

            $tanggalKey = $tanggal->format('Y-m-d');

            $grafikLabel[] = $tanggal->format('d');

            $grafikData[] = $peminjamanPerTanggal
                ->get($tanggalKey, collect())
                ->count();

            $tanggal->addDay();
        }

        // Nama bulan untuk judul grafik
        $namaBulan = $bulanSebelumnya->locale('id')
            ->translatedFormat('F Y');


        /*
        |--------------------------------------------------------------------------
        | PEMINJAMAN TERBARU
        |--------------------------------------------------------------------------
        */

        $peminjamanTerbaru = Peminjaman::with('peminjam')
            ->latest()
            ->take(5)
            ->get();


        /*
        |--------------------------------------------------------------------------
        | USER MENUNGGU VALIDASI
        |--------------------------------------------------------------------------
        */

        $penggunaPending = User::with('roles')
            ->where('status_validasi', 'menunggu')
            ->where('is_aktif', false)
            ->orderBy('created_at', 'desc')
            ->get();


        /*
        |--------------------------------------------------------------------------
        | AKTIVITAS TERBARU
        |--------------------------------------------------------------------------
        */

        $aktivitasTerbaru = LogAktivitas::with('pengguna')
            ->latest('created_at')
            ->take(5)
            ->get();


        return view('dasbor.admin', compact(
            'totalAlat',
            'totalPengguna',
            'totalPeminjaman',
            'totalPengembalian',

            'statusDiajukan',
            'statusDipinjam',
            'statusVerifikasi',
            'statusSelesai',

            'grafikLabel',
            'grafikData',
            'namaBulan',

            'peminjamanTerbaru',
            'penggunaPending',
            'aktivitasTerbaru'
        ));
    }
}
