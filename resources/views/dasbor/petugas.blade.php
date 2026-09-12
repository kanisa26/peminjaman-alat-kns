@extends('layouts.utama')

@section('judul', 'Dasbor Petugas')

@section('konten')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="dashboard-header mb-4">
        <div>
            <h4 class="fw-bold mb-1">Dasbor Petugas</h4>
            <p class="text-muted mb-0">
                Selamat datang, {{ auth()->user()->nama }}.
                Berikut ringkasan aktivitas peminjaman alat.
            </p>
        </div>
    </div>


    {{-- STATISTIK --}}
<div class="row g-4 mb-4">

    {{-- DISETUJUI --}}
    <div class="col-lg-4 col-md-6">
        <a href="{{ route('persetujuan.antrian') }}" class="dashboard-link">
            <div class="dashboard-card card-disetujui">

                <div class="card-content">
                    <div>
                        <span class="stat-label">Disetujui</span>

                        <h2 class="stat-number">
                            {{ $jumlahDisetujui }}
                        </h2>

                        <p class="stat-description">
                            Peminjaman yang telah disetujui
                        </p>
                    </div>

                    <div class="stat-image image-blue">
                        <i class="bi bi-check-circle-fill"></i>
                    </div>
                </div>

                <div class="card-bottom">
                    <span>
                        <i class="bi bi-check2-circle me-1"></i>
                        Data persetujuan
                    </span>

                    <span class="lihat-link">
                        Lihat
                        <i class="bi bi-arrow-right"></i>
                    </span>
                </div>

            </div>
        </a>
    </div>


    {{-- PEMANTAUAN --}}
    <div class="col-lg-4 col-md-6">
        <a href="{{ url('/pengembalian/pantau') }}" class="dashboard-link">
            <div class="dashboard-card card-pemantauan">

                <div class="card-content">
                    <div>
                        <span class="stat-label">Pemantauan</span>

                        <h2 class="stat-number">
                            {{ $jumlahDipinjam }}
                        </h2>

                        <p class="stat-description">
                            Peminjaman yang sedang berlangsung
                        </p>
                    </div>

                    <div class="stat-image image-green">
                        <i class="bi bi-box-seam-fill"></i>
                    </div>
                </div>

                <div class="card-bottom">
                    <span>
                        <i class="bi bi-activity me-1"></i>
                        Pantau peminjaman
                    </span>

                    <span class="lihat-link">
                        Lihat
                        <i class="bi bi-arrow-right"></i>
                    </span>
                </div>

            </div>
        </a>
    </div>


    {{-- VERIFIKASI --}}
    <div class="col-lg-4 col-md-6">
        <a href="{{ url('/pengembalian/antrian') }}" class="dashboard-link">
            <div class="dashboard-card card-verifikasi">

                <div class="card-content">
                    <div>
                        <span class="stat-label">Verifikasi</span>

                        <h2 class="stat-number">
                            {{ $jumlahVerifikasi }}
                        </h2>

                        <p class="stat-description">
                            Pengembalian yang perlu diverifikasi
                        </p>
                    </div>

                    <div class="stat-image image-yellow">
                        <i class="bi bi-shield-check-fill"></i>
                    </div>
                </div>

                <div class="card-bottom">
                    <span>
                        <i class="bi bi-clipboard-check me-1"></i>
                        Perlu diverifikasi
                    </span>

                    <span class="lihat-link">
                        Lihat
                        <i class="bi bi-arrow-right"></i>
                    </span>
                </div>

            </div>
        </a>
    </div>

</div>


    {{-- PENGAJUAN TERBARU --}}
    <div class="card latest-card border-0 shadow-sm">

        <div class="card-header latest-header">

            <div class="d-flex justify-content-between align-items-center">

                <div class="d-flex align-items-center">

                    <div class="title-icon">
                        <i class="bi bi-bell-fill"></i>
                    </div>

                    <div>
                        <h5 class="fw-bold mb-1">
                            Pengajuan Peminjaman Terbaru
                        </h5>

                        <p class="text-muted mb-0">
                            Daftar peminjam yang baru mengajukan peminjaman.
                        </p>
                    </div>

                </div>

                <a href="{{ route('persetujuan.antrian') }}"
                   class="btn btn-primary btn-sm px-3">

                    Lihat Semua
                    <i class="bi bi-arrow-right ms-1"></i>

                </a>

            </div>

        </div>


        <div class="card-body p-0">

            @if($pengajuanTerbaru->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead>

                            <tr>
                                <th class="px-4">Peminjam</th>
                                <th>Jumlah Alat</th>
                                <th>Tanggal Pengajuan</th>
                                <th>Keperluan</th>
                                <th>Status</th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach($pengajuanTerbaru as $peminjaman)

                                <tr>

                                    {{-- PEMINJAM --}}
                                    <td class="px-4">

                                        <div class="d-flex align-items-center">

                                            <div class="user-icon me-3">
                                                <i class="bi bi-person-fill"></i>
                                            </div>

                                            <div>

                                                <div class="fw-semibold">
                                                    {{ $peminjaman->peminjam->nama ?? '-' }}
                                                </div>

                                                <small class="text-muted">
                                                    {{ $peminjaman->kode_pinjam }}
                                                </small>

                                            </div>

                                        </div>

                                    </td>


                                    {{-- JUMLAH ALAT --}}
                                    <td>
                                        <span class="alat-count">
                                            <i class="bi bi-box me-1"></i>
                                            {{ $peminjaman->detail->sum('jumlah') }} alat
                                        </span>
                                    </td>


                                    {{-- TANGGAL --}}
                                    <td>
                                        <div class="date-text">
                                            <i class="bi bi-calendar3 me-1"></i>
                                            {{ $peminjaman->created_at->format('d/m/Y') }}
                                        </div>

                                        <small class="text-muted">
                                            {{ $peminjaman->created_at->format('H:i') }}
                                        </small>
                                    </td>


                                    {{-- KEPERLUAN --}}
                                    <td>
                                        {{ $peminjaman->keperluan ?? '-' }}
                                    </td>


                                    {{-- STATUS --}}
                                    <td>
                                        <span class="status-badge">
                                            <span class="status-dot"></span>
                                            Menunggu
                                        </span>
                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="empty-state">

                    <div class="empty-icon">
                        <i class="bi bi-inbox"></i>
                    </div>

                    <h6 class="fw-bold mt-3">
                        Belum ada pengajuan baru
                    </h6>

                    <p class="text-muted mb-0">
                        Pengajuan dari peminjam akan muncul di sini.
                    </p>

                </div>

            @endif

        </div>

    </div>

</div>


{{-- CSS --}}
<style>

    /* =========================
       HEADER
    ========================= */

    .dashboard-header {
        padding-top: 5px;
    }

    .dashboard-header h4 {
        font-size: 24px;
        color: #172033;
    }


    /* =========================
       STAT CARD
    ========================= */

    .dashboard-card {
        position: relative;
        background: #ffffff;
        border-radius: 18px;
        padding: 22px;
        border: 1px solid #edf0f5;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.04);
        transition: all 0.25s ease;
        overflow: hidden;
    }

    .dashboard-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 12px 30px rgba(0, 0, 0, 0.09);
    }

    .dashboard-card::after {
        content: "";
        position: absolute;
        width: 90px;
        height: 90px;
        border-radius: 50%;
        right: -30px;
        bottom: -35px;
        opacity: 0.08;
    }

    .card-pengajuan::after {
        background: #0d6efd;
    }

    .card-dipinjam::after {
        background: #198754;
    }

    .card-pengembalian::after {
        background: #f0ad00;
    }

    .card-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .stat-label {
        display: block;
        color: #667085;
        font-size: 14px;
        margin-bottom: 8px;
    }

    .stat-number {
        font-size: 32px;
        line-height: 1;
        margin-bottom: 8px;
        color: #172033;
    }

    .stat-description {
        color: #98a2b3;
        font-size: 13px;
        margin: 0;
    }


    .stat-icon


    /* =========================
       BOTTOM STAT CARD
    ========================= */

    .card-bottom {
    display: flex;
    align-items: center;

    margin-top: 20px;
    padding-top: 14px;

    border-top: 1px solid #f0f2f5;

    font-size: 12px;
    color: #98a2b3;
}

.card-bottom > span:first-child {
    color: #98a2b3;
}

.lihat-link {
    margin-left: auto;

    color: #0d6efd;
    font-weight: 600;
    text-decoration: none;

    display: inline-flex;
    align-items: center;
    gap: 4px;

    transition: all 0.2s ease;
}

.lihat-link:hover {
    color: #0056d6;
    transform: translateX(3px);
}

.lihat-link i {
    margin-left: 0;
}

    .card-bottom a {
        color: #0d6efd;
        text-decoration: none;
        font-weight: 600;
    }

    .card-bottom a:hover {
        text-decoration: underline;
    }


    /* =========================
       SECTION TITLE
    ========================= */

    .section-title h5 {
        color: #172033;
    }


    /* =========================
       QUICK MENU
    ========================= */

    .quick-menu {
        display: flex;
        align-items: center;
        gap: 13px;

        position: relative;

        background: #ffffff;
        border: 1px solid #edf0f5;
        border-radius: 15px;

        padding: 17px;

        text-decoration: none;
        color: inherit;

        box-shadow: 0 3px 12px rgba(0, 0, 0, 0.03);

        transition: all 0.2s ease;
    }

    .quick-menu:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.07);
    }

    .quick-menu h6 {
        margin: 0 0 4px;
        font-weight: 700;
        color: #172033;
    }

    .quick-menu p {
        margin: 0;
        color: #98a2b3;
        font-size: 11px;
    }

    .quick-icon {
        width: 45px;
        height: 45px;
        border-radius: 12px;

        display: flex;
        align-items: center;
        justify-content: center;

        flex-shrink: 0;
    }

    .quick-icon i {
        font-size: 20px;
    }

    .quick-icon.blue {
        background: #e8f1ff;
        color: #0d6efd;
    }

    .quick-icon.green {
        background: #e5f6ee;
        color: #198754;
    }

    .quick-icon.yellow {
        background: #fff5d9;
        color: #d99a00;
    }

    .quick-icon.purple {
        background: #eee9ff;
        color: #7656d6;
    }

    .arrow {
        margin-left: auto;
        color: #adb5bd;
        font-size: 14px;
    }


    /* =========================
       LATEST CARD
    ========================= */

    .latest-card {
        border-radius: 18px;
        overflow: hidden;
    }

    .latest-header {
        background: #ffffff;
        padding: 22px;
        border-bottom: 1px solid #f0f2f5;
    }

    .title-icon {
        width: 43px;
        height: 43px;
        border-radius: 12px;

        background: #e8f1ff;
        color: #0d6efd;

        display: flex;
        align-items: center;
        justify-content: center;

        margin-right: 13px;
    }

    .title-icon i {
        font-size: 18px;
    }


    /* =========================
       TABLE
    ========================= */

    .table thead th {
        background: #f8fafc;
        color: #344054;
        font-size: 13px;
        font-weight: 700;
        border-bottom: 1px solid #e5e7eb;
        padding-top: 15px;
        padding-bottom: 15px;
        white-space: nowrap;
    }

    .table tbody td {
        padding-top: 16px;
        padding-bottom: 16px;
        font-size: 13px;
    }

    .table tbody tr {
        transition: background 0.15s ease;
    }


    /* =========================
       USER ICON
    ========================= */

    .user-icon {
        width: 42px;
        height: 42px;

        border-radius: 50%;

        background: #eef4ff;
        color: #0d6efd;

        display: flex;
        align-items: center;
        justify-content: center;
    }

    .user-icon i {
        font-size: 18px;
    }


    /* =========================
       TABLE INFO
    ========================= */

    .alat-count {
        color: #475467;
        font-weight: 500;
    }

    .date-text {
        color: #344054;
    }


    /* =========================
       STATUS
    ========================= */

    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;

        background: #fff5d9;
        color: #9a6700;

        padding: 6px 10px;
        border-radius: 20px;

        font-size: 11px;
        font-weight: 600;
    }

    .status-dot {
        width: 6px;
        height: 6px;
        border-radius: 50%;
        background: #e0a400;
    }


    /* =========================
       EMPTY STATE
    ========================= */

    .empty-state {
        text-align: center;
        padding: 55px 20px;
    }

    .empty-icon {
        width: 75px;
        height: 75px;

        margin: auto;

        border-radius: 50%;

        background: #f2f4f7;
        color: #98a2b3;

        display: flex;
        align-items: center;
        justify-content: center;
    }

    .empty-icon i {
        font-size: 32px;
    }


    /* =========================
       RESPONSIVE
    ========================= */

    @media (max-width: 768px) {

        .dashboard-header h4 {
            font-size: 21px;
        }

        .stat-icon {
            width: 60px;
            height: 60px;
        }

        .stat-icon i {
            font-size: 26px;
        }

        .latest-header .d-flex {
            align-items: flex-start !important;
        }

    }

    /* =========================
   DASHBOARD LINK
========================= */

.dashboard-link {
    text-decoration: none;
    color: inherit;
    display: block;
}

.dashboard-link:hover {
    color: inherit;
}


/* =========================
   STAT IMAGE
========================= */

.stat-image {
    width: 70px;
    height: 70px;
    border-radius: 18px;

    display: flex;
    align-items: center;
    justify-content: center;

    flex-shrink: 0;
}

.stat-image i {
    font-size: 30px;
}

.image-blue {
    background: #e8f1ff;
    color: #0d6efd;
}

.image-green {
    background: #e5f6ee;
    color: #198754;
}

.image-yellow {
    background: #fff5d9;
    color: #d99a00;
}


/* =========================
   CARD COLORS
========================= */

.card-disetujui::after {
    background: #0d6efd;
}

.card-pemantauan::after {
    background: #198754;
}

.card-verifikasi::after {
    background: #f0ad00;
}


/* =========================
   LIHAT
========================= */

.lihat-link {
    color: #0d6efd;
    font-weight: 600;
    text-decoration: none;
}

.lihat-link i {
    margin-left: 4px;
}

</style>

@endsection