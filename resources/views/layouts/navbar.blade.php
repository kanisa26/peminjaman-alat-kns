
<nav class="navbar navbar-expand-lg navbar-sipenal">
    <div class="container-fluid px-4">

        {{-- BRAND --}}
<a class="navbar-brand brand-sipenal" href="{{ url('/') }}">

    <img src="{{ asset('gambar/logo-stock.png') }}"
         alt="Logo SIPENAL"
         class="logo-sipenal">

    <div class="brand-text">
        <span class="brand-title">SIPENAL</span>
        <span class="brand-subtitle">Sistem Peminjaman Barang</span>
    </div>

</a>

        {{-- TOGGLE MOBILE --}}
        <button class="navbar-toggler"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#menuUtama"
                aria-controls="menuUtama"
                aria-expanded="false"
                aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="menuUtama">

            {{-- MENU UTAMA --}}
            <ul class="navbar-nav me-auto align-items-lg-center">

            @php
    $pending = auth()->check() && !auth()->user()->is_aktif;
@endphp

                {{-- DASBOR --}}
                <li class="nav-item">
    @if(auth()->user()->hasRole('admin'))
        <a class="nav-link {{ request()->is('admin/dasbor') ? 'menu-aktif' : '' }}"
           href="{{ route('admin.dasbor') }}">
            Dasbor
        </a>

    @elseif(auth()->user()->hasRole('petugas'))
        <a class="nav-link {{ request()->is('petugas/dasbor') ? 'menu-aktif' : '' }}"
           href="{{ route('petugas.dasbor') }}">
            Dasbor
        </a>

    @elseif(auth()->user()->hasRole('peminjam'))
        <a class="nav-link {{ request()->is('peminjam/dasbor') ? 'menu-aktif' : '' }}"
           href="{{ route('peminjam.dasbor') }}">
            Dasbor
        </a>
    @endif
</li>
@if(!$pending)

                {{-- KATEGORI --}}
                @can('kategori.kelola')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('kategori*') ? 'menu-aktif' : '' }}"
                           href="/kategori">
                            Kategori
                        </a>
                    </li>
                @endcan

                {{-- ALAT --}}
                @can('alat.kelola')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('alat*') ? 'menu-aktif' : '' }}"
                           href="{{ route('alat.index') }}">
                            Alat
                        </a>
                    </li>
                @endcan

                {{-- PENGGUNA --}}
                @can('user.kelola')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('pengguna*') ? 'menu-aktif' : '' }}"
                           href="{{ route('pengguna.index') }}">
                            Pengguna
                        </a>
                    </li>
                @endcan

                {{-- LOG AKTIVITAS --}}
                @can('log.lihat')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('log-aktivitas*') ? 'menu-aktif' : '' }}"
                           href="{{ route('log.index') }}">
                            Log Aktivitas
                        </a>
                    </li>
                @endcan

                {{-- PERSETUJUAN --}}
                @can('peminjaman.setujui')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('persetujuan*') ? 'menu-aktif' : '' }}"
                           href="{{ route('persetujuan.antrian') }}">
                            Persetujuan
                        </a>
                    </li>
                @endcan

                {{-- DATA PEMINJAMAN --}}
                @can('peminjaman.kelola')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('koreksi/peminjaman*') ? 'menu-aktif' : '' }}"
                           href="{{ route('koreksi.peminjaman.daftar') }}">
                            Data Peminjaman
                        </a>
                    </li>
                @endcan

                {{-- DATA PENGEMBALIAN --}}
                @can('pengembalian.kelola')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('koreksi/pengembalian*') ? 'menu-aktif' : '' }}"
                           href="{{ route('koreksi.pengembalian.daftar') }}">
                            Data Pengembalian
                        </a>
                    </li>
                @endcan

                {{-- PENGATURAN --}}
                @can('pengaturan.kelola')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('pengaturan*') ? 'menu-aktif' : '' }}"
                           href="{{ route('pengaturan.form') }}">
                            Pengaturan
                        </a>
                    </li>
                @endcan

                {{-- PEMANTAUAN --}}
                @can('pengembalian.pantau')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('pengembalian/pantau*') ? 'menu-aktif' : '' }}"
                           href="{{ route('pengembalian.pantau') }}">
                            Pemantauan
                        </a>
                    </li>

                    {{-- VERIFIKASI --}}
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('pengembalian/antrian*') ? 'menu-aktif' : '' }}"
                           href="{{ route('pengembalian.antrian') }}">
                            Verifikasi
                        </a>
                    </li>
                @endcan

                {{-- LAPORAN --}}
                @can('laporan.cetak')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('laporan*') ? 'menu-aktif' : '' }}"
                           href="{{ route('laporan.form') }}">
                            Laporan
                        </a>
                    </li>
                @endcan

                {{-- KATALOG --}}
                @can('alat.lihat')
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('katalog') && !request()->is('katalog/keranjang') ? 'menu-aktif' : '' }}"
                           href="{{ route('katalog.daftar') }}">
                            Katalog Alat
                        </a>
                    </li>

                    {{-- KERANJANG --}}
<li class="nav-item">
    <a class="nav-link {{ request()->is('katalog/keranjang') ? 'menu-aktif' : '' }}"
       href="{{ route('katalog.keranjang') }}">
        Keranjang

        @php
            $jumlahKeranjang = app(\App\Services\Keranjang::class)->jumlahBaris();
        @endphp

        @if ($jumlahKeranjang > 0)
            <span class="badge bg-warning text-dark ms-1">
                {{ $jumlahKeranjang }}
            </span>
        @endif
    </a>
</li>

                    {{-- PINJAMAN SAYA --}}
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('peminjaman/saya') ? 'menu-aktif' : '' }}"
                           href="{{ route('peminjaman.saya') }}">
                            Pinjaman Saya
                        </a>
                    </li>
                @endcan
                
                @endif
            </ul>

            {{-- BAGIAN KANAN --}}
            @auth
    <ul class="navbar-nav align-items-center">

        <li class="nav-item dropdown">

            <a class="nav-link dropdown-toggle profil-navbar"
               href="#"
               id="menuProfil"
               role="button"
               data-bs-toggle="dropdown"
               aria-expanded="false">

                {{-- FOTO PROFIL --}}
<span class="foto-profil-navbar">

    @if(auth()->user()->foto)
        <img src="{{ asset('storage/' . auth()->user()->foto) }}"
             alt="Foto Profil"
             class="foto-navbar-img">
    @else
        <i class="bi bi-person-fill ikon-default"></i>
    @endif

</span>

                {{-- NAMA --}}
                <span class="nama-administrator">
                    {{ auth()->user()->nama }}
                </span>

            </a>

            <ul class="dropdown-menu dropdown-menu-end shadow-sm"
                aria-labelledby="menuProfil">

                {{-- PROFIL --}}
                <li>
                    <a class="dropdown-item"
                       href="{{ route('profil.index') }}">

                        <i class="bi bi-person me-2"></i>
                        Profil Saya

                    </a>
                </li>

                <li>
                    <hr class="dropdown-divider">
                </li>

                {{-- LOGOUT --}}
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf

                        <button type="submit"
                                class="dropdown-item text-danger">

                            <i class="bi bi-box-arrow-right me-2"></i>
                            Keluar

                        </button>
                    </form>
                </li>

            </ul>

        </li>

    </ul>
@endauth

        </div>
    </div>
</nav>


{{-- STYLE NAVBAR --}}
<style>
    /* ================================
       NAVBAR SIPENAL
    ================================= */

    .navbar-sipenal {
        background-color: #0d6efd;
        min-height: 64px;
        padding: 8px 0;
    }

    /* BRAND */
    .navbar-sipenal .navbar-brand {
        color: #ffffff;
        font-size: 20px;
        letter-spacing: 0.3px;
        margin-right: 22px;
        white-space: nowrap;
    }

    .navbar-sipenal .navbar-brand:hover {
        color: #ffffff;
    }

    /* MENU */
    .navbar-sipenal .nav-link {
        color: rgba(255, 255, 255, 0.80) !important;
        font-size: 14px;
        font-weight: 500;
        padding: 9px 11px !important;
        margin: 0 2px;
        border-radius: 9px;

        white-space: nowrap;

        transition:
            background-color 0.2s ease,
            color 0.2s ease;
    }

    /* HOVER */
    .navbar-sipenal .nav-link:hover {
        color: #ffffff !important;
        background-color: rgba(255, 255, 255, 0.10);
    }

    /* MENU AKTIF */
    .navbar-sipenal .nav-link.menu-aktif {
        color: #ffffff !important;
        background-color: #084298;
        font-weight: 700;
    }

    /* HOVER MENU AKTIF */
    .navbar-sipenal .nav-link.menu-aktif:hover {
        color: #ffffff !important;
        background-color: #06357a;
    }

    /* BADGE KERANJANG */
    .navbar-sipenal .badge {
        font-size: 11px;
        border-radius: 20px;
        vertical-align: middle;
    }

    /* NAMA USER */
    .navbar-sipenal .nama-user {
        color: #ffffff !important;
        font-size: 14px;
        font-weight: 500;
        white-space: nowrap;
    }

    /* TOMBOL KELUAR */
    .navbar-sipenal .btn-keluar {
        background-color: #dc3545;
        border: none;
        color: #ffffff;
        font-size: 14px;
        font-weight: 700;
        padding: 7px 15px;
        border-radius: 7px;
        white-space: nowrap;
        transition: background-color 0.2s ease;
    }

    .navbar-sipenal .btn-keluar:hover {
        background-color: #bb2d3b;
        color: #ffffff;
    }

    /* TOGGLE MOBILE */
    .navbar-sipenal .navbar-toggler {
        border-color: rgba(255, 255, 255, 0.4);
    }

    /* DESKTOP - JANGAN TURUN BARIS */
    @media (min-width: 992px) {
        .navbar-sipenal .navbar-nav {
            flex-wrap: nowrap;
        }

        .navbar-sipenal .navbar-collapse {
            flex-wrap: nowrap;
        }
    }

    /* LAPTOP YANG LEBIH KECIL */
    @media (min-width: 992px) and (max-width: 1300px) {
        .navbar-sipenal .nav-link {
            font-size: 12px;
            padding-left: 7px !important;
            padding-right: 7px !important;
        }

        .navbar-sipenal .navbar-brand {
            font-size: 18px;
            margin-right: 10px;
        }
    }

 /* ================================
   BRAND SIPENAL
================================ */

.brand-sipenal {
    display: flex;
    align-items: center;
    color: white !important;
    font-weight: 700;
    text-decoration: none;
    min-width: 175px;
}

/* LOGO */
.logo-sipenal {
    width: 48px;
    height: 48px;
    object-fit: contain;
    margin-right: 8px;
    transform: scale(1.25);
}

/* TEKS BRAND */
.brand-text {
    display: flex;
    flex-direction: column;
    justify-content: center;
    line-height: 1.1;
}

/* SIPENAL */
.brand-title {
    color: #ffffff;
    font-size: 20px;
    font-weight: 700;
    letter-spacing: 0.3px;
}

/* SUBTITLE */
.brand-subtitle {
    color: rgba(255, 255, 255, 0.75);
    font-size: 9px;
    font-weight: 400;
    margin-top: 3px;
    letter-spacing: 0.2px;
}

/* ================================
   PROFIL NAVBAR
================================ */

.profil-navbar {
    display: flex !important;
    align-items: center;
    gap: 8px;
    color: #ffffff !important;
}

/* FOTO BULAT */
.foto-profil-navbar {
    width: 34px;
    height: 34px;
    border-radius: 50%;
    overflow: hidden;
    background-color: #ffffff;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}

/* FOTO */
.foto-profil-navbar img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

/* ICON JIKA FOTO TIDAK ADA */
.foto-profil-navbar .ikon-default {
    color: #0d6efd;
    font-size: 19px;
    display: none;
}

/* NAMA ADMIN */
.nama-administrator {
    color: #ffffff;
    font-size: 14px;
    font-weight: 500;
    white-space: nowrap;
}

/* DROPDOWN */
.navbar-sipenal .dropdown-menu {
    min-width: 190px;
    border: none;
    border-radius: 10px;
    padding: 8px;
}

/* ITEM DROPDOWN */
.navbar-sipenal .dropdown-item {
    border-radius: 7px;
    padding: 9px 12px;
    font-size: 14px;
}

/* HOVER DROPDOWN */
.navbar-sipenal .dropdown-item:hover {
    background-color: #f1f5f9;
}

/* ICON DROPDOWN */
.navbar-sipenal .dropdown-item i {
    width: 18px;
}
</style>