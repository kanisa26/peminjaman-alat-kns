<?php

namespace App\Http\Controllers;

use App\Models\Alat;
use App\Models\User;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Models\LogAktivitas;
use App\Enums\StatusPeminjaman;

class DasborAdminController extends Controller
{
    public function index()
    {
        $totalAlat = Alat::count();

        /*
         * Hanya pengguna yang:
         * - sudah disetujui
         * - dan aktif
         */
        $totalPengguna = User::where(
            'status_validasi',
            'disetujui'
        )
        ->where('is_aktif', true)
        ->count();

        $totalPeminjaman = Peminjaman::count();

        $totalPengembalian = Pengembalian::count();


        /*
         * STATUS PEMINJAMAN
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
         * PEMINJAMAN TERBARU
         */

        $peminjamanTerbaru = Peminjaman::with('peminjam')
            ->latest()
            ->take(5)
            ->get();


        /*
         * USER YANG MENUNGGU VALIDASI
         *
         * HANYA yang statusnya "menunggu".
         *
         * Admin yang dibuat lewat menu Pengguna
         * sudah disetujui, jadi tidak akan masuk sini.
         *
         * User yang ditolak juga tidak akan masuk sini.
         */
        $penggunaPending = User::with('roles')
            ->where('status_validasi', 'menunggu')
            ->where('is_aktif', false)
            ->orderBy('created_at', 'desc')
            ->get();


        /*
         * AKTIVITAS TERBARU
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
            'peminjamanTerbaru',
            'penggunaPending',
            'aktivitasTerbaru'
        ));
    }
}