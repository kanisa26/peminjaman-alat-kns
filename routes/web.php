<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PersetujuanController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/admin/dasbor', function () {
        return view('dasbor.admin');
    })->middleware('role:admin')->name('admin.dasbor');

    Route::get('/petugas/dasbor', function () {
        return view('dasbor.petugas');
    })->middleware('role:petugas')->name('petugas.dasbor');

    Route::get('/peminjam/dasbor', function () {
        return view('dasbor.peminjam');
    })->middleware('role:peminjam')->name('peminjam.dasbor');

    Route::resource('kategori', KategoriController::class)
    ->except(['show'])
    ->middleware('permission:kategori.kelola');

    Route::resource('alat', AlatController::class)
        ->except(['show'])
        ->middleware('permission:alat.kelola');

    Route::resource('pengguna', PenggunaController::class)
        ->except(['show'])
        ->middleware('permission:user.kelola');

    Route::middleware('permission:alat.lihat')
        ->prefix('katalog')
        ->name('katalog.')
        ->group(function () {

            Route::get('/', [KatalogController::class, 'katalog'])
                ->name('daftar');

            Route::get('/keranjang', [KatalogController::class, 'lihatKeranjang'])
                ->name('keranjang');

            Route::post('/alat/{alat}/tambah', [KatalogController::class, 'tambahKeKeranjang'])
                ->name('tambah');

            Route::put('/{alat}/jumlah', [KatalogController::class, 'ubahJumlah'])
                ->name('ubah-jumlah');

            Route::delete('/{alatId}/hapus', [KatalogController::class, 'hapusDariKeranjang'])
                ->name('hapus');

            Route::delete('/kosongkan', [KatalogController::class, 'kosongkanKeranjang'])
                ->name('kosongkan');
        });

    Route::middleware('permission:peminjaman.ajukan')
        ->prefix('peminjaman')
        ->name('peminjaman.')
        ->group(function () {

            Route::get('/ajukan', [PeminjamanController::class, 'formPengajuan'])
                ->name('ajukan');

            Route::post('/ajukan', [PeminjamanController::class, 'simpanPengajuan'])
                ->name('simpan');

            Route::get('/saya', [PeminjamanController::class, 'daftarSaya'])
                ->name('saya');

            Route::get('/{peminjaman}', [PeminjamanController::class, 'rincian'])
                ->name('rincian');
        });

    Route::middleware(['auth'])->group(function () {
    Route::middleware('permission:peminjaman.setujui')
        ->prefix('persetujuan')
        ->name('persetujuan.')
        ->group(function () {
            Route::get('/', [PersetujuanController::class, 'antrian'])->name('antrian');
            Route::get('/{peminjaman}', [PersetujuanController::class, 'rincian'])->name('rincian');
            Route::post('/{peminjaman}/setujui', [PersetujuanController::class, 'setujui'])->name('setujui');
            Route::post('/{peminjaman}/tolak', [PersetujuanController::class, 'tolak'])->name('tolak');
        });
    });
});