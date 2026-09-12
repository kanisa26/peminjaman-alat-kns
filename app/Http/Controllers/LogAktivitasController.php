<?php

namespace App\Http\Controllers;

use App\Models\LogAktivitas;
use App\Models\User;
use Illuminate\Http\Request;

class LogAktivitasController extends Controller
{
    public function index(Request $request)
    {
        $userId = $request->query('user_id');
        $aksi = $request->query('aksi');
        $tglAwal = $request->query('tgl_awal');
        $tglAkhir = $request->query('tgl_akhir');

        $daftarPengguna = User::orderBy('nama')->get();

        $pilihanAksi = LogAktivitas::query()
            ->select('aksi')
            ->distinct()
            ->orderBy('aksi')
            ->pluck('aksi');

        $daftarLog = LogAktivitas::query()
            ->with('pengguna')
            ->when($userId, function ($query) use ($userId) {
                $query->where('user_id', $userId);
            })
            ->when($aksi, function ($query) use ($aksi) {
                $query->where('aksi', $aksi);
            })
            ->when($tglAwal, function ($query) use ($tglAwal) {
                $query->whereDate('created_at', '>=', $tglAwal);
            })
            ->when($tglAkhir, function ($query) use ($tglAkhir) {
                $query->whereDate('created_at', '<=', $tglAkhir);
            })
            ->orderByDesc('created_at')
            ->paginate(20)
            ->withQueryString();

        return view('log.daftar', compact(
            'daftarLog',
            'daftarPengguna',
            'pilihanAksi',
            'userId',
            'aksi',
            'tglAwal',
            'tglAkhir'
        ));
    }
}