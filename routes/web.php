<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\AlatController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\KatalogController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\PersetujuanController;
use App\Http\Controllers\PengembalianController;
use App\Http\Controllers\LogAktivitasController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\KoreksiPeminjamanController;
use App\Http\Controllers\KoreksiPengembalianController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\ProfileController;
use App\Models\Alat;
use App\Models\User;
use App\Models\Peminjaman;
use App\Models\Pengembalian;
use App\Enums\StatusPeminjaman;
use App\Http\Controllers\DasborAdminController;
use App\Models\Kategori;
use App\Http\Controllers\AuthController;

Route::get('/', function () {

    $totalAlat = Alat::count();
    $totalKategori = Kategori::count();
    $totalPeminjaman = Peminjaman::count();
    $totalPengguna = User::count();

    return view('home', compact(
        'totalAlat',
        'totalKategori',
        'totalPeminjaman',
        'totalPengguna'
    ));

})->name('home');

// ====================
// AUTH / LOGIN
// ====================

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.proses');


// ====================
// AUTH / REGISTER
// ====================

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register.store');

Route::get('/register/success/{id}', [AuthController::class, 'registerSuccess'])
    ->name('register.success');

Route::get('/register/edit/{id}', [AuthController::class, 'editRegister'])
    ->name('register.edit');

Route::put('/register/edit/{id}', [AuthController::class, 'updateRegister'])
    ->name('register.update');

    // ====================
// DASHBOARD ADMIN
// ====================

Route::get('/admin/dasbor', [DasborAdminController::class, 'index'])
    ->middleware('role:admin')
    ->name('admin.dasbor');

    Route::get('/petugas/dasbor', function () {

    // Jumlah pengajuan yang menunggu persetujuan petugas
    $jumlahDisetujui = Peminjaman::where(
        'status',
        StatusPeminjaman::Diajukan->value
    )->count();

    // Jumlah peminjaman yang sedang berlangsung
    $jumlahDipinjam = Peminjaman::where(
        'status',
        StatusPeminjaman::Dipinjam->value
    )->count();

    // Jumlah pengembalian yang menunggu verifikasi
    $jumlahVerifikasi = Peminjaman::where(
        'status',
        StatusPeminjaman::MenungguVerifikasi->value
    )->count();

    // Ambil 5 pengajuan terbaru
    $pengajuanTerbaru = Peminjaman::with([
        'peminjam',
        'detail'
    ])
    ->where(
        'status',
        StatusPeminjaman::Diajukan->value
    )
    ->latest('created_at')
    ->take(5)
    ->get();

    return view('dasbor.petugas', compact(
        'jumlahDisetujui',
        'jumlahDipinjam',
        'jumlahVerifikasi',
        'pengajuanTerbaru'
    ));

})->middleware('role:petugas')->name('petugas.dasbor');


Route::get('/peminjam/dasbor', function () {

    $userId = auth()->id();

    // Total pengajuan milik peminjam
    $jumlahPengajuan = Peminjaman::where(
        'user_id',
        $userId
    )->count();

    // Sedang dipinjam
    $jumlahDipinjam = Peminjaman::where(
        'user_id',
        $userId
    )
    ->where(
        'status',
        StatusPeminjaman::Dipinjam->value
    )
    ->count();

    // Menunggu verifikasi pengembalian
    $jumlahVerifikasi = Peminjaman::where(
        'user_id',
        $userId
    )
    ->where(
        'status',
        StatusPeminjaman::MenungguVerifikasi->value
    )
    ->count();

    // 5 peminjaman terbaru milik sendiri
    $peminjamanTerbaru = Peminjaman::where(
        'user_id',
        $userId
    )
    ->latest()
    ->take(5)
    ->get();

    return view('dasbor.peminjam', compact(
        'jumlahPengajuan',
        'jumlahDipinjam',
        'jumlahVerifikasi',
        'peminjamanTerbaru'
    ));

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

        Route::post('/pengguna/validasi', [PenggunaController::class, 'validasi'])
    ->middleware('permission:user.kelola')
    ->name('pengguna.validasi');

    Route::post('/pengguna/tolak', [PenggunaController::class, 'tolak'])
    ->middleware('permission:user.kelola')
    ->name('pengguna.tolak');

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

    Route::middleware('permission:peminjaman.ajukan')
    ->group(function () {

        Route::post('/peminjaman/{peminjaman}/kembalikan',
            [PengembalianController::class, 'ajukan']
        )->name('peminjaman.pengembalian.ajukan');
    });

    Route::middleware('permission:pengembalian.pantau')
    ->prefix('pengembalian')
    ->name('pengembalian.')
    ->group(function () {

        Route::get('/pantau', [PengembalianController::class, 'pantau'])
            ->name('pantau');

        Route::get('/antrian', [PengembalianController::class, 'antrian'])
            ->name('antrian');

        Route::get(
            '/{peminjaman}/verifikasi',
            [PengembalianController::class, 'formVerifikasi']
        )->name('verifikasi');

        Route::post(
            '/{peminjaman}/verifikasi',
            [PengembalianController::class, 'simpanVerifikasi']
        )->name('simpan');

        Route::get(
            '/rincian/{pengembalian}',
            [PengembalianController::class, 'rincian']
        )->name('rincian');
    });

    Route::middleware(['auth'])->group(function () {
    Route::middleware('permission:log.lihat')
        ->get('/log-aktivitas', [LogAktivitasController::class, 'index'])
        ->name('log.index');
    });

    Route::middleware('permission:laporan.cetak')
        ->prefix('laporan')
        ->name('laporan.')
        ->group(function () {

            Route::get('/', [LaporanController::class, 'form'])
                ->name('form');

            Route::get('/peminjaman', [LaporanController::class, 'peminjaman'])
                ->name('peminjaman');

            Route::get('/pengembalian', [LaporanController::class, 'pengembalian'])
                ->name('pengembalian');

            Route::get('/stok', [LaporanController::class, 'stok'])
                ->name('stok');
        });

        Route::middleware('permission:peminjaman.kelola')
        ->prefix('koreksi/peminjaman')
        ->name('koreksi.peminjaman.')
        ->group(function () {
            Route::get('/', [KoreksiPeminjamanController::class, 'daftar'])->name('daftar');
            Route::get('/{peminjaman}/ubah', [KoreksiPeminjamanController::class, 'formUbah'])->name('ubah');
            Route::put('/{peminjaman}', [KoreksiPeminjamanController::class, 'perbarui'])->name('perbarui');
            Route::delete('/{peminjaman}', [KoreksiPeminjamanController::class, 'hapus'])->name('hapus');
        });

    Route::middleware('permission:pengembalian.kelola')
        ->prefix('koreksi/pengembalian')
        ->name('koreksi.pengembalian.')
        ->group(function () {
            Route::get('/', [KoreksiPengembalianController::class, 'daftar'])->name('daftar');
            Route::get('/{pengembalian}/ubah', [KoreksiPengembalianController::class, 'formUbah'])->name('ubah');
            Route::put('/{pengembalian}', [KoreksiPengembalianController::class, 'perbarui'])->name('perbarui');
        });

        Route::middleware('permission:pengaturan.kelola')
    ->prefix('pengaturan')
    ->name('pengaturan.')
    ->group(function () {
        Route::get('/', [PengaturanController::class, 'form'])->name('form');
        Route::put('/', [PengaturanController::class, 'perbarui'])->name('perbarui');
    });

    Route::middleware('auth')->group(function () {

    Route::get('/profil', [ProfileController::class, 'index'])
        ->name('profil.index');

    Route::put('/profil', [ProfileController::class, 'update'])
        ->name('profil.update');

    Route::put('/profil/password', [ProfileController::class, 'updatePassword'])
        ->name('profil.password');

});
