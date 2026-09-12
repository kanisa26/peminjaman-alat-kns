@extends('layouts.utama')

@section('judul', 'Dasbor Admin')

@section('konten')


@if(session('gagal'))

@endif


@if(auth()->user()->status_validasi === 'ditolak')

<div class="alert alert-danger border-0 shadow-sm mb-4">
    <h5 class="mb-2">❌ Akun Tidak Disetujui</h5>

    <p class="mb-2">
        Akun Anda tidak disetujui oleh Administrator.
    </p>

    @if(auth()->user()->alasan_penolakan)
        <hr>

        <p class="mb-0">
            <strong>Alasan Penolakan:</strong><br>
            {{ auth()->user()->alasan_penolakan }}
        </p>
    @endif
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h1>❌</h1>
                <h5>Akun Ditolak</h5>

                <p class="text-muted">
                    Silakan hubungi Administrator apabila ingin mengajukan kembali.
                </p>
            </div>
        </div>
    </div>
</div>

@elseif(auth()->user()->status_validasi === 'menunggu')

<div class="alert alert-warning border-0 shadow-sm mb-4">

    <h5 class="mb-2">
        ⏳ Akun Menunggu Validasi
    </h5>

    <p class="mb-2">
        Akun Anda telah berhasil dibuat, namun masih menunggu persetujuan dari Administrator.
    </p>

    <hr>

    <ul class="mb-0">
        <li>Anda hanya dapat melihat halaman ini.</li>
        <li>Anda belum dapat mengelola data alat.</li>
        <li>Anda belum dapat mengelola pengguna.</li>
        <li>Anda belum dapat melihat log aktivitas.</li>
        <li>Anda belum dapat melakukan validasi pengguna.</li>
    </ul>

</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <div class="card shadow-sm border-0">
            <div class="card-body text-center">
                <h1>🔒</h1>
                <h5>Dashboard Terbatas</h5>

                <p class="text-muted">
                    Fitur akan aktif setelah Admin Utama melakukan validasi akun.
                </p>
            </div>
        </div>
    </div>
</div>

@else

<style>
    .dashboard-container {
        padding: 10px 0;
    }

    .dashboard-header {
        margin-bottom: 25px;
    }

    .dashboard-header h4 {
        margin-bottom: 6px;
        font-weight: 700;
        font-size: 26px;
    }

    .dashboard-header p {
        margin-bottom: 4px;
        font-size: 16px;
        font-weight: 600;
    }

    .dashboard-header small {
        color: #6b7280;
    }

    /* =========================
       STAT CARD
    ========================= */

    .stat-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 18px;
        margin-bottom: 22px;
    }

    .stat-card {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 20px;
    display: flex;
    align-items: center;
    gap: 15px;
    box-shadow: 0 2px 8px rgba(0,0,0,.04);

    /* Card bisa diklik */
    cursor: pointer;

    /* Animasi */
    transition:
        transform 0.2s ease,
        box-shadow 0.2s ease;
}

/* Saat cursor mendekati card */
.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 8px 18px rgba(0, 0, 0, 0.10);
}

    .stat-icon {
        width: 52px;
        height: 52px;
        border-radius: 10px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #f3f4f6;
        font-size: 24px;
        flex-shrink: 0;
    }

    .stat-title {
        margin: 0;
        font-size: 12px;
        font-weight: 700;
        color: #6b7280;
    }

    .stat-number {
        margin: 4px 0 0;
        font-size: 27px;
        font-weight: 700;
        color: #111827;
    }

    .stat-desc {
        margin: 0;
        font-size: 12px;
        color: #6b7280;
    }

/* =========================
   DASHBOARD BAWAH
========================= */

.dashboard-layout {
    display: grid;
    grid-template-columns: 1.3fr 1fr;
    gap: 22px;
    align-items: start;
    margin-bottom: 25px;
}

.dashboard-left,
.dashboard-right {
    display: flex;
    flex-direction: column;
    gap: 22px;
}

/* SEMUA BAGIAN DASHBOARD MENJADI CARD */

.dashboard-box {
    background: #fff;
    border: 1px solid #e5e7eb;
    border-radius: 12px;
    padding: 20px;
    box-shadow: 0 2px 8px rgba(0,0,0,.04);
}

.dashboard-box h5 {
    margin: 0 0 18px;
    font-size: 18px;
    font-weight: 600;
    color: #111827;
}


/* =========================
   STATUS PEMINJAMAN
========================= */

.status-box {
    min-height: 285px;
}

.status-content {
    display: flex;
    align-items: center;
    gap: 35px;
}

/* =========================
   DONAT STATUS PEMINJAMAN
========================= */

.status-donut-wrapper {
    width: 230px;
    height: 230px;
    position: relative;

    display: flex;
    align-items: center;
    justify-content: center;

    flex-shrink: 0;
}


.donut-segment {
    fill: none;

    stroke-width: 28;

    stroke-linecap: butt;

    cursor: pointer;

    transition:
        stroke-width .2s ease,
        opacity .2s ease,
        filter .2s ease;
}

.donut-segment:hover {
    stroke-width: 31;

    opacity: .92;

    filter: drop-shadow(0 3px 5px rgba(0,0,0,.18));
}


/* =========================
   TENGAH DONAT
========================= */

.status-donut-inner {
    position: absolute;

    width: 116px;
    height: 116px;

    background: #fff;

    border-radius: 50%;

    display: flex;
    flex-direction: column;

    align-items: center;
    justify-content: center;

    pointer-events: none;

    box-shadow: 0 2px 8px rgba(0,0,0,.06);
}

.status-donut-inner strong {
    font-size: 30px;

    font-weight: 700;

    line-height: 1;

    color: #111827;
}

.status-donut-inner small {
    margin-top: 6px;

    font-size: 12px;

    color: #6b7280;
}


/* =========================
   PERSENTASE DONAT
========================= */

.donut-percentage {
    position: absolute;

    transform: translate(-50%, -50%);

    color: #fff;

    font-size: 10px;

    font-weight: 700;

    line-height: 1;

    white-space: nowrap;

    pointer-events: none;

    z-index: 5;

    text-shadow:
        0 1px 3px rgba(0,0,0,.6);
}


/* =========================
   PERSENTASE
========================= */

.donut-percentage {
    position: absolute;

    transform: translate(-50%, -50%);

    color: #fff;

    font-size: 10px;

    font-weight: 700;

    line-height: 1;

    white-space: nowrap;

    pointer-events: none;

    z-index: 5;

    text-shadow:
        0 1px 3px rgba(0,0,0,.55);
}


/* =========================
   TOOLTIP
========================= */

.donut-tooltip {
    position: fixed;

    display: none;

    background: #111827;

    color: #fff;

    padding: 8px 11px;

    border-radius: 7px;

    font-size: 12px;

    line-height: 1.5;

    pointer-events: none;

    z-index: 99999;

    box-shadow:
        0 5px 15px rgba(0,0,0,.15);
}

.donut-tooltip.show {
    display: block;
}


/* =========================
   KETERANGAN STATUS
========================= */

.status-info {
    flex: 1;
}

.status-row {
    display: flex;
    align-items: center;

    padding: 13px 0;

    border-bottom: 1px solid #edf2f7;
}

.status-row:last-child {
    border-bottom: none;
}

.status-label {
    display: flex;
    align-items: center;
    gap: 10px;

    font-size: 14px;
}

.status-dot {
    width: 11px;
    height: 11px;

    border-radius: 50%;

    flex-shrink: 0;
}


/* =========================
   VALIDASI PENGGUNA
========================= */

.validation-box {
    height: 285px;
    min-height: 285px;
    display: flex;
    flex-direction: column;
}

.validation-list {
    width: 100%;

    flex: 1;

    overflow-y: auto;
    overflow-x: hidden;

    padding-right: 6px;
}

.validation-user-item {
    display: grid;

    grid-template-columns: 1fr 100px 90px;

    align-items: center;

    gap: 10px;

    padding: 13px 0;

    border-bottom: 1px solid #edf2f7;
}

.validation-user-item:first-child {
    padding-top: 0;
}

.validation-user-item:last-child {
    border-bottom: none;
}

.validation-user-info {
    display: flex;
    flex-direction: column;
    gap: 3px;
}

.validation-username {
    font-size: 14px;
    font-weight: 700;
    color: #111827;
}

.validation-role {
    font-size: 12px;
    color: #6b7280;
}

.validation-name {
    font-size: 13px;
    color: #374151;
}

.btn-validasi {
    border: none;

    background: #0d6efd;
    color: #fff;

    padding: 8px 12px;

    border-radius: 6px;

    font-size: 12px;
    font-weight: 600;

    cursor: pointer;

    transition: .2s;
}

.btn-validasi:hover {
    background: #0b5ed7;
    transform: translateY(-1px);
}

.validation-list::-webkit-scrollbar {
    width: 6px;
}

.validation-list::-webkit-scrollbar-track {
    background: #f3f4f6;
    border-radius: 10px;
}

.validation-list::-webkit-scrollbar-thumb {
    background: #cbd5e1;
    border-radius: 10px;
}

.validation-list::-webkit-scrollbar-thumb:hover {
    background: #94a3b8;
}


/* =========================
   PEMINJAMAN TERBARU
========================= */

.latest-box {
    width: 100%;
}

.table-header {
    display: flex;
    justify-content: space-between;
    align-items: center;

    margin-bottom: 10px;
}

.table-header h5 {
    margin-bottom: 0;
}

.table-header a {
    color: #0d6efd;

    font-size: 13px;

    text-decoration: none;
}

.table-header a:hover {
    text-decoration: underline;
}

.dashboard-table {
    width: 100%;
    border-collapse: collapse;
}

.dashboard-table th {
    padding: 11px 10px;

    font-size: 12px;
    font-weight: 700;

    color: #374151;

    text-align: left;

    border-bottom: 1px solid #e5e7eb;
}

.dashboard-table td {
    padding: 12px 10px;

    border-bottom: 1px solid #edf2f7;

    font-size: 13px;
}

.dashboard-table tbody tr:hover {
    background: #f8fafc;
}

.kode-pinjam {
    font-weight: 700;
    color: #2563eb;
}

.badge {
    display: inline-block;

    padding: 6px 11px;

    border-radius: 30px;

    font-size: 11px;
    font-weight: 700;
}

.badge-diajukan {
    background: #eef2ff;
    color: #2563eb;
}

.badge-dipinjam {
    background: #dcfce7;
    color: #16a34a;
}

.badge-verifikasi {
    background: #fef3c7;
    color: #ca8a04;
}

.badge-selesai {
    background: #e5e7eb;
    color: #374151;
}

.empty-data {
    text-align: center;
    color: #9ca3af;
}


/* =========================
   AKTIVITAS TERBARU
========================= */

.activity-item {
    display: flex;
    align-items: center;

    gap: 10px;

    padding: 13px 0;

    border-bottom: 1px solid #edf2f7;

    font-size: 13px;
    color: #374151;
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-dot {
    width: 8px;
    height: 8px;

    background: #0d6efd;

    border-radius: 50%;

    flex-shrink: 0;
}


/* =========================
   RESPONSIVE
========================= */

@media (max-width: 1000px) {

    .dashboard-layout {
        grid-template-columns: 1fr;
    }

}

@media (max-width: 650px) {

    .status-content {
        flex-direction: column;
        align-items: flex-start;
    }

    .validation-user-item {
        grid-template-columns: 1fr auto;
    }

    .validation-name {
        display: none;
    }

}


/* =========================
   MODAL VALIDASI
========================= */

.validation-modal {
    display: none;
    position: fixed;
    inset: 0;

    background: rgba(0,0,0,.45);

    z-index: 9999;

    align-items: center;
    justify-content: center;
}

.validation-modal.show {
    display: flex;
}

.validation-modal-content {
    width: 430px;
    max-width: calc(100% - 30px);

    background: #fff;

    border-radius: 14px;

    padding: 25px;

    box-shadow: 0 15px 40px rgba(0,0,0,.18);
}

.validation-modal-content h5 {
    margin: 0 0 20px;
    font-size: 18px;
}

.modal-question {
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 18px;
}

.modal-info {
    background: #f9fafb;
    padding: 14px;
    border-radius: 8px;
    margin-bottom: 18px;
}

.modal-info div {
    font-size: 13px;
    margin-bottom: 7px;
}

.modal-info div:last-child {
    margin-bottom: 0;
}

.modal-info span {
    display: inline-block;
    width: 75px;
    color: #6b7280;
}

.modal-description {
    font-size: 12px;
    color: #6b7280;
    line-height: 1.6;
    margin-bottom: 20px;
}

.modal-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

.btn-batal {
    border: 1px solid #d1d5db;
    background: #fff;
    color: #374151;

    padding: 9px 16px;
    border-radius: 7px;

    font-size: 13px;
    cursor: pointer;
}

.btn-validasi-modal {
    border: none;
    background: #0d6efd;
    color: #fff;

    padding: 9px 16px;
    border-radius: 7px;

    font-size: 13px;
    font-weight: 600;

    cursor: pointer;
}

@media (max-width: 1000px) {

    .dashboard-layout {
        grid-template-columns: 1fr;
    }

}

@media (max-width: 650px) {

    .status-content {
        flex-direction: column;
        align-items: flex-start;
    }

    .validation-user-item {
        grid-template-columns: 1fr auto;
    }

    .validation-name {
        display: none;
    }

}

/* =========================
   MODAL VALIDASI
========================= */

.validation-modal {
    display: none;
    position: fixed;
    inset: 0;
    background: rgba(0, 0, 0, .45);
    z-index: 9999;
    align-items: center;
    justify-content: center;
}

.validation-modal.show {
    display: flex;
}

.validation-modal-content {
    width: 430px;
    max-width: calc(100% - 30px);
    background: #fff;
    border-radius: 14px;
    padding: 25px;
    box-shadow: 0 15px 40px rgba(0,0,0,.18);
}

.validation-modal-content h5 {
    margin: 0 0 20px;
    font-size: 18px;
}

.modal-question {
    font-size: 14px;
    line-height: 1.6;
    margin-bottom: 18px;
}

.modal-info {
    background: #f9fafb;
    padding: 14px;
    border-radius: 8px;
    margin-bottom: 18px;
}

.modal-info div {
    font-size: 13px;
    margin-bottom: 7px;
}

.modal-info div:last-child {
    margin-bottom: 0;
}

.modal-info span {
    display: inline-block;
    width: 75px;
    color: #6b7280;
}

.modal-description {
    font-size: 12px;
    color: #6b7280;
    line-height: 1.6;
    margin-bottom: 20px;
}

.modal-actions {
    display: flex;
    justify-content: flex-end;
    gap: 10px;
}

.btn-batal {
    border: 1px solid #d1d5db;
    background: #fff;
    color: #374151;
    padding: 9px 16px;
    border-radius: 7px;
    font-size: 13px;
    cursor: pointer;
}

.btn-validasi-modal {
    border: none;
    background: #0d6efd;
    color: #fff;
    padding: 9px 16px;
    border-radius: 7px;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
}

@media (max-width: 1000px) {
    .dashboard-layout {
        grid-template-columns: 1fr;
    }

    .availability-content {
        justify-content: flex-start;
    }
}

@media (max-width: 600px) {
    .availability-content {
        flex-direction: column;
        gap: 20px;
    }
}

.activity-box {
    width: 100%;
}

.activity-box h5 {
    margin-bottom: 10px;
}

.activity-item {
    display: flex;
    align-items: flex-start;

    gap: 10px;

    padding: 13px 0;

    border-bottom: 1px solid #edf2f7;

    font-size: 13px;
    color: #374151;
}

.activity-item:last-child {
    border-bottom: none;
}

.activity-dot {
    width: 8px;
    height: 8px;

    background: #0d6efd;

    border-radius: 50%;

    flex-shrink: 0;

    margin-top: 5px;
}

.btn-tolak {
    border: 1px solid #dc3545;
    background: #fff;
    color: #dc3545;

    padding: 8px 12px;

    border-radius: 6px;

    font-size: 12px;
    font-weight: 600;

    cursor: pointer;

    transition: .2s;
}

.btn-tolak:hover {
    background: #dc3545;
    color: #fff;
    transform: translateY(-1px);
}
</style>


<div class="dashboard-container">

    {{-- HEADER --}}
    <div class="dashboard-header">

        <h4>Dasbor Admin</h4>

        <p>
            Selamat datang, {{ auth()->user()->nama }}!
        </p>

        <small>
            Berikut ringkasan aktivitas sistem peminjaman alat.
        </small>

    </div>


    {{-- =================================
         STAT CARD
    ================================== --}}

    <div class="stat-grid">

    {{-- TOTAL ALAT --}}
    <a href="{{ route('alat.index') }}" class="stat-card text-decoration-none">

        <div class="stat-icon">
            📦
        </div>

        <div>
            <p class="stat-title">TOTAL ALAT</p>

            <div class="stat-number">
                {{ $totalAlat }}
            </div>

            <p class="stat-desc">
                alat
            </p>
        </div>

    </a>


    {{-- PENGGUNA --}}
    <a href="{{ route('pengguna.index') }}" class="stat-card text-decoration-none">

        <div class="stat-icon">
            👥
        </div>

        <div>
            <p class="stat-title">PENGGUNA</p>

            <div class="stat-number">
                {{ $totalPengguna }}
            </div>

            <p class="stat-desc">
                pengguna
            </p>
        </div>

    </a>


    {{-- PEMINJAMAN --}}
    <a href="{{ route('koreksi.peminjaman.daftar') }}" class="stat-card text-decoration-none">

        <div class="stat-icon">
            📋
        </div>

        <div>
            <p class="stat-title">PEMINJAMAN</p>

            <div class="stat-number">
                {{ $totalPeminjaman ?? 0 }}
            </div>

            <p class="stat-desc">
                transaksi aktif
            </p>
        </div>

    </a>


    {{-- PENGEMBALIAN --}}
    <a href="{{ route('koreksi.pengembalian.daftar') }}" class="stat-card text-decoration-none">

        <div class="stat-icon">
            ↩
        </div>

        <div>
            <p class="stat-title">PENGEMBALIAN</p>

            <div class="stat-number">
                {{ $totalPengembalian ?? 0 }}
            </div>

            <p class="stat-desc">
                transaksi selesai
            </p>
        </div>

    </a>

</div>

{{-- =================================
     DASHBOARD BAWAH
================================== --}}

<div class="dashboard-layout">

    {{-- =================================
         KOLOM KIRI
    ================================== --}}
    <div class="dashboard-left">

        {{-- =========================
             STATUS PEMINJAMAN
        ========================== --}}
        <div class="dashboard-box status-box">

            <h5>STATUS PEMINJAMAN</h5>

            @php

                $total =
                    $statusDiajukan +
                    $statusDipinjam +
                    $statusVerifikasi +
                    $statusSelesai;

                $persenDiajukan = $total > 0
                    ? round(($statusDiajukan / $total) * 100)
                    : 0;

                $persenDipinjam = $total > 0
                    ? round(($statusDipinjam / $total) * 100)
                    : 0;

                $persenVerifikasi = $total > 0
                    ? round(($statusVerifikasi / $total) * 100)
                    : 0;

                $persenSelesai = $total > 0
                    ? round(($statusSelesai / $total) * 100)
                    : 0;

            @endphp

            <div class="status-content">

                {{-- DONAT --}}
                <div class="status-donut-wrapper">

                    <svg
                        class="status-donut-svg"
                        viewBox="0 0 190 190"
                    >

                        <g transform="rotate(-90 95 95)">

                            {{-- DIAJUKAN --}}
<circle
    class="donut-segment"
    cx="95"
    cy="95"
    r="68"
    stroke="#facc15"
    data-status="Diajukan"
    data-jumlah="{{ $statusDiajukan }}"
    data-persen="{{ $persenDiajukan }}"
/>

{{-- DIPINJAM --}}
<circle
    class="donut-segment"
    cx="95"
    cy="95"
    r="68"
    stroke="#2563eb"
    data-status="Dipinjam"
    data-jumlah="{{ $statusDipinjam }}"
    data-persen="{{ $persenDipinjam }}"
/>

{{-- MENUNGGU VERIFIKASI --}}
<circle
    class="donut-segment"
    cx="95"
    cy="95"
    r="68"
    stroke="#60a5fa"
    data-status="Menunggu Verifikasi"
    data-jumlah="{{ $statusVerifikasi }}"
    data-persen="{{ $persenVerifikasi }}"
/>

{{-- SELESAI --}}
<circle
    class="donut-segment"
    cx="95"
    cy="95"
    r="68"
    stroke="#15803d"
    data-status="Selesai"
    data-jumlah="{{ $statusSelesai }}"
    data-persen="{{ $persenSelesai }}"
/>

                        </g>

                    </svg>


                    {{-- TENGAH DONAT --}}
                    <div class="status-donut-inner">

                        <strong>{{ $total }}</strong>

                        <small>Total</small>

                    </div>


                    {{-- TOOLTIP --}}
                    <div
                        class="donut-tooltip"
                        id="donutTooltip"
                    ></div>

                </div>


                {{-- KETERANGAN STATUS --}}
                <div class="status-info">

                    <div class="status-row">
                        <div class="status-label">

                            <span
                                class="status-dot"
                                style="background:#facc15"
                            ></span>

                            <span>Diajukan</span>

                        </div>
                    </div>


                    <div class="status-row">
                        <div class="status-label">

                            <span
                                class="status-dot"
                                style="background:#2563eb"
                            ></span>

                            <span>Dipinjam</span>

                        </div>
                    </div>


                    <div class="status-row">
                        <div class="status-label">

                            <span
                                class="status-dot"
                                style="background:#60a5fa"
                            ></span>

                            <span>Menunggu Verifikasi</span>

                        </div>
                    </div>


                    <div class="status-row">
                        <div class="status-label">

                            <span
                                class="status-dot"
                                style="background:#15803d"
                            ></span>

                            <span>Selesai</span>

                        </div>
                    </div>

                </div>

            </div>

        </div>


        {{-- =========================
             PEMINJAMAN TERBARU
        ========================== --}}
        <div class="dashboard-box latest-box">

            <div class="table-header">

                <h5>PEMINJAMAN TERBARU</h5>

                <a href="{{ route('koreksi.peminjaman.daftar') }}">
                    Lihat Semua →
                </a>

            </div>


            <div style="overflow-x:auto;">

                <table class="dashboard-table">

                    <thead>

                        <tr>
                            <th>Kode</th>
                            <th>Peminjam</th>
                            <th>Tgl Pinjam</th>
                            <th>Status</th>
                        </tr>

                    </thead>


                    <tbody>

                        @forelse($peminjamanTerbaru as $pinjam)

                            <tr>

                                <td>
                                    <span class="kode-pinjam">
                                        {{ $pinjam->kode_pinjam }}
                                    </span>
                                </td>

                                <td>
                                    {{ $pinjam->peminjam->nama ?? '-' }}
                                </td>

                                <td>
                                    {{ $pinjam->tgl_pinjam?->format('d M Y') }}
                                </td>

                                <td>

                                    @if($pinjam->status == \App\Enums\StatusPeminjaman::Diajukan)

                                        <span class="badge badge-diajukan">
                                            Diajukan
                                        </span>

                                    @elseif($pinjam->status == \App\Enums\StatusPeminjaman::Dipinjam)

                                        <span class="badge badge-dipinjam">
                                            Dipinjam
                                        </span>

                                    @elseif($pinjam->status == \App\Enums\StatusPeminjaman::MenungguVerifikasi)

                                        <span class="badge badge-verifikasi">
                                            Menunggu Verifikasi
                                        </span>

                                    @elseif($pinjam->status == \App\Enums\StatusPeminjaman::Selesai)

                                        <span class="badge badge-selesai">
                                            Selesai
                                        </span>

                                    @endif

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td
                                    colspan="4"
                                    class="empty-data"
                                >
                                    Belum ada peminjaman.
                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>

        </div>

    </div>


    {{-- =================================
         KOLOM KANAN
    ================================== --}}
    <div class="dashboard-right">

        {{-- =========================
             VALIDASI PENGGUNA
        ========================== --}}
        <div class="dashboard-box validation-box">

            <h5>VALIDASI PENGGUNA</h5>

            <div class="validation-list">

                @forelse($penggunaPending as $user)

                    <div class="validation-user-item">

                        <div class="validation-user-info">

                            <span class="validation-username">
                                {{ $user->username }}
                            </span>

                            <span class="validation-role">
                                {{ ucfirst($user->roles->first()?->name ?? '-') }}
                            </span>

                        </div>

                        <div class="validation-name">
                            {{ $user->nama }}
                        </div>

                        <div style="display:flex; gap:6px; justify-content:flex-end;">

    <button
        type="button"
        class="btn-tolak"
        onclick="bukaModalTolak(
            '{{ $user->id }}',
            '{{ $user->username }}',
            '{{ $user->nama }}',
            '{{ ucfirst($user->roles->first()?->name ?? '-') }}'
        )"
    >
        Tolak
    </button>

    <button
        type="button"
        class="btn-validasi"
        onclick="bukaModalValidasi(
            '{{ $user->id }}',
            '{{ $user->username }}',
            '{{ $user->nama }}',
            '{{ ucfirst($user->roles->first()?->name ?? '-') }}'
        )"
    >
        Valid
    </button>

</div>

                    </div>

                @empty

                    <div class="empty-data" style="padding: 25px 0;">
                        Tidak ada pengguna yang menunggu validasi.
                    </div>

                @endforelse

            </div>

        </div>


        {{-- =========================
             AKTIVITAS TERBARU
        ========================== --}}
        <div class="dashboard-box activity-box">

            <h5>AKTIVITAS TERBARU</h5>

            @forelse($aktivitasTerbaru as $log)

                <div class="activity-item">

                    <span class="activity-dot"></span>

                    <span>

                        <strong>
                            {{ $log->pengguna->nama ?? '-' }}
                        </strong>

                        <br>

                        {{ $log->deskripsi }}

                    </span>

                </div>

            @empty

                <div class="empty-data">
                    Belum ada aktivitas.
                </div>

            @endforelse

        </div>

    </div>

</div>


{{-- =================================
     MODAL VALIDASI
================================== --}}

<div
    class="validation-modal"
    id="validationModal"
    onclick="tutupModalJikaKlikLuar(event)"
>

    <div
        class="validation-modal-content"
        onclick="event.stopPropagation()"
    >

        <h5>Validasi Pengguna</h5>

        <p class="modal-question">
            Apakah pengguna berikut boleh menggunakan sistem?
        </p>

        <div class="modal-info">

            <div>
                <span>Username</span>
                <strong id="modalUsername">-</strong>
            </div>

            <div>
                <span>Nama</span>
                <strong id="modalNama">-</strong>
            </div>

            <div>
                <span>Role</span>
                <strong id="modalRole">-</strong>
            </div>

        </div>

        <p class="modal-description">
            Pengguna yang divalidasi dapat menggunakan sistem
            sesuai dengan role yang diberikan.
        </p>

        {{-- FORM VALIDASI --}}
        <form
            method="POST"
            action="{{ route('pengguna.validasi') }}"
            id="formValidasi"
        >

            @csrf

            <input
                type="hidden"
                name="user_id"
                id="modalUserId"
            >

            <div class="modal-actions">

                <button
                    type="button"
                    class="btn-batal"
                    onclick="tutupModalValidasi()"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    class="btn-validasi-modal"
                >
                    Validasi
                </button>

            </div>

        </form>

    </div>

</div>


{{-- =================================
     MODAL TOLAK PENGGUNA
================================== --}}

<div
    class="validation-modal"
    id="tolakModal"
    onclick="tutupModalJikaKlikLuarTolak(event)"
>

    <div
        class="validation-modal-content"
        onclick="event.stopPropagation()"
    >

        <h5>Tolak Pengguna</h5>

        <p class="modal-question">
            Apakah Anda yakin ingin menolak pengguna berikut?
        </p>

        <div class="modal-info">

            <div>
                <span>Username</span>
                <strong id="tolakUsername">-</strong>
            </div>

            <div>
                <span>Nama</span>
                <strong id="tolakNama">-</strong>
            </div>

            <div>
                <span>Role</span>
                <strong id="tolakRole">-</strong>
            </div>

        </div>

        {{-- FORM TOLAK --}}
        <form
            method="POST"
            action="{{ route('pengguna.tolak') }}"
            id="formTolak"
        >

            @csrf

            <input
                type="hidden"
                name="user_id"
                id="tolakUserId"
            >

            <div style="margin-bottom:20px;">

                <label
                    for="alasanPenolakan"
                    style="
                        display:block;
                        font-size:13px;
                        font-weight:600;
                        margin-bottom:7px;
                    "
                >
                    Alasan Penolakan
                </label>

                <textarea
                    name="alasan_penolakan"
                    id="alasanPenolakan"
                    rows="4"
                    placeholder="Masukkan alasan penolakan..."
                    style="
                        width:100%;
                        border:1px solid #d1d5db;
                        border-radius:7px;
                        padding:10px;
                        font-size:13px;
                        resize:none;
                    "
                ></textarea>

            </div>

            <div class="modal-actions">

                <button
                    type="button"
                    class="btn-batal"
                    onclick="tutupModalTolak()"
                >
                    Batal
                </button>

                <button
                    type="submit"
                    style="
                        border:none;
                        background:#dc3545;
                        color:#fff;
                        padding:9px 16px;
                        border-radius:7px;
                        font-size:13px;
                        font-weight:600;
                        cursor:pointer;
                    "
                >
                    Tolak Pengguna
                </button>

            </div>

        </form>

    </div>

</div>


<script>

function bukaModalValidasi(id, username, nama, role) {

    document.getElementById('modalUsername').textContent = username;
    document.getElementById('modalNama').textContent = nama;
    document.getElementById('modalRole').textContent = role;

    document.getElementById('modalUserId').value = id;

    document
        .getElementById('validationModal')
        .classList.add('show');
}


function tutupModalValidasi() {

    document
        .getElementById('validationModal')
        .classList.remove('show');

}


function tutupModalJikaKlikLuar(event) {

    if (event.target.id === 'validationModal') {
        tutupModalValidasi();
    }

}


/* ==========================================
   MODAL TOLAK
========================================== */

function bukaModalTolak(id, username, nama, role) {

    document.getElementById('tolakUsername').textContent = username;
    document.getElementById('tolakNama').textContent = nama;
    document.getElementById('tolakRole').textContent = role;

    document.getElementById('tolakUserId').value = id;

    document.getElementById('alasanPenolakan').value = '';

    document
        .getElementById('tolakModal')
        .classList.add('show');
}


function tutupModalTolak() {

    document
        .getElementById('tolakModal')
        .classList.remove('show');

}


function tutupModalJikaKlikLuarTolak(event) {

    if (event.target.id === 'tolakModal') {
        tutupModalTolak();
    }

}


/* ==========================================
   VALIDASI ALASAN PENOLAKAN
========================================== */

document.getElementById('formTolak')
    ?.addEventListener('submit', function(event) {

        const alasan =
            document.getElementById('alasanPenolakan')
                .value
                .trim();

        if (alasan === '') {

            event.preventDefault();

            alert('Alasan penolakan wajib diisi.');

            return;
        }

    });


/* ==========================================
   DONAT STATUS PEMINJAMAN
========================================== */

document.addEventListener('DOMContentLoaded', function () {

    const segments =
        document.querySelectorAll('.donut-segment');

    const percentages =
        document.querySelectorAll('.donut-percentage');

    const tooltip =
        document.getElementById('donutTooltip');

    const radius = 68;

    const circumference =
        2 * Math.PI * radius;

    let totalPersen = 0;

    const data = [];


    segments.forEach((segment) => {

        const persen =
            Number(segment.dataset.persen);

        if (persen <= 0) {

            segment.style.display = 'none';

            return;
        }

        const panjang =
            (persen / 100) * circumference;

        segment.style.strokeDasharray =
            `${panjang} ${circumference}`;

        segment.style.strokeDashoffset =
            `-${(totalPersen / 100) * circumference}`;

        data.push({

            persen: persen,

            mulai: totalPersen,

            selesai: totalPersen + persen

        });

        totalPersen += persen;


        segment.addEventListener(
            'mouseenter',
            function () {

                const status =
                    segment.dataset.status;

                const jumlah =
                    segment.dataset.jumlah;

                const persen =
                    segment.dataset.persen;

                tooltip.innerHTML = `
                    <strong>${status}</strong><br>
                    Jumlah: ${jumlah}<br>
                    Persentase: ${persen}%
                `;

                tooltip.classList.add('show');

            }
        );


        segment.addEventListener(
            'mousemove',
            function (event) {

                tooltip.style.left =
                    (event.clientX + 12) + 'px';

                tooltip.style.top =
                    (event.clientY + 12) + 'px';

            }
        );


        segment.addEventListener(
            'mouseleave',
            function () {

                tooltip.classList.remove('show');

            }
        );

    });


    percentages.forEach((label) => {

        const index =
            Number(label.dataset.percent);

        const item = data[index];

        if (!item || item.persen <= 0) {

            label.style.display = 'none';

            return;
        }

        const persenTengah =
            item.mulai + (item.persen / 2);

        const sudut =
            (persenTengah / 100) *
            2 *
            Math.PI -
            Math.PI / 2;

        const radiusText = 68;

        const x =
            95 +
            Math.cos(sudut) *
            radiusText;

        const y =
            95 +
            Math.sin(sudut) *
            radiusText;

        label.style.left =
            (x / 190 * 100) + '%';

        label.style.top =
            (y / 190 * 100) + '%';

    });

});


/* ==========================================
   DONAT STATUS PEMINJAMAN
========================================== */

document.addEventListener('DOMContentLoaded', function () {

    const segments = document.querySelectorAll('.donut-segment');
    const percentages = document.querySelectorAll('.donut-percentage');
    const tooltip = document.getElementById('donutTooltip');

    const radius = 68;
    const circumference = 2 * Math.PI * radius;

    let totalPersen = 0;
    const data = [];

    /* =========================
       MEMBUAT POTONGAN DONAT
    ========================= */

    segments.forEach((segment) => {

        const persen = Number(segment.dataset.persen);

        /*
         * Kalau 0%, jangan tampilkan
         */
        if (persen <= 0) {
            segment.style.display = 'none';
            return;
        }

        const panjang = (persen / 100) * circumference;

        segment.style.strokeDasharray =
            `${panjang} ${circumference}`;

        segment.style.strokeDashoffset =
            `-${(totalPersen / 100) * circumference}`;

        data.push({
            persen: persen,
            mulai: totalPersen,
            selesai: totalPersen + persen
        });

        totalPersen += persen;


        /* =========================
           TOOLTIP
        ========================= */

        segment.addEventListener('mouseenter', function () {

            const status = segment.dataset.status;
            const jumlah = segment.dataset.jumlah;
            const persen = segment.dataset.persen;

            tooltip.innerHTML = `
                <strong>${status}</strong><br>
                Jumlah: ${jumlah}<br>
                Persentase: ${persen}%
            `;

            tooltip.classList.add('show');

        });


        segment.addEventListener('mousemove', function (event) {

            tooltip.style.left =
                (event.clientX + 12) + 'px';

            tooltip.style.top =
                (event.clientY + 12) + 'px';

        });


        segment.addEventListener('mouseleave', function () {

            tooltip.classList.remove('show');

        });

    });


    /* =========================
       POSISI PERSENTASE
    ========================= */

    percentages.forEach((label) => {

        const index = Number(label.dataset.percent);

        const item = data[index];

        if (!item || item.persen <= 0) {
            label.style.display = 'none';
            return;
        }

        /*
         * Cari posisi tengah bagian donat
         */
        const persenTengah =
            item.mulai + (item.persen / 2);

        /*
         * Mulai dari atas
         */
        const sudut =
            (persenTengah / 100) * 2 * Math.PI
            - Math.PI / 2;

        /*
         * Posisi teks di tengah garis donat
         */
        const radiusText = 68;

        const x =
            95 + Math.cos(sudut) * radiusText;

        const y =
            95 + Math.sin(sudut) * radiusText;

        /*
         * Sesuaikan dengan wrapper 230px
         */
        label.style.left =
            (x / 190 * 100) + '%';

        label.style.top =
            (y / 190 * 100) + '%';

    });

    function bukaModalTolak(id, username, nama, role) {

    document.getElementById('tolakUsername').textContent = username;
    document.getElementById('tolakNama').textContent = nama;
    document.getElementById('tolakRole').textContent = role;

    document.getElementById('tolakUserId').value = id;

    document.getElementById('alasanPenolakan').value = '';

    document
        .getElementById('tolakModal')
        .classList.add('show');
}


function tutupModalTolak() {

    document
        .getElementById('tolakModal')
        .classList.remove('show');

}


function tutupModalJikaKlikLuarTolak(event) {

    if (event.target.id === 'tolakModal') {
        tutupModalTolak();
    }

}


/*
 * Sebelum form dikirim,
 * masukkan isi textarea ke hidden input.
 */

document.getElementById('formTolak')
    ?.addEventListener('submit', function(event) {

        const alasan =
            document.getElementById('alasanPenolakan').value.trim();

        if (alasan === '') {

            event.preventDefault();

            alert('Alasan penolakan wajib diisi.');

            return;
        }

        document.getElementById('inputAlasanPenolakan').value = alasan;

    });

});

</script>

@endif

@endsection