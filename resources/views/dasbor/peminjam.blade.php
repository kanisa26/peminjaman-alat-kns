@extends('layouts.utama')

@section('judul', 'Dasbor Peminjam')

@section('konten')

<div class="container-fluid">

    {{-- HEADER --}}
    <div class="mb-4">
        <h4 class="fw-bold mb-1">
            Dasbor Peminjam
        </h4>

        <p class="text-muted mb-0">
            Selamat datang, {{ auth()->user()->nama }}.
        </p>
    </div>


    {{-- STATISTIK --}}
    <div class="row g-4 mb-4">

        {{-- Pengajuan --}}
        <div class="col-md-4">

            <div class="card border-0 shadow-sm dashboard-card">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between">

                        <div>
                            <p class="text-muted mb-2">
                                Pengajuan Saya
                            </p>

                            <h2 class="fw-bold">
                                {{ $jumlahPengajuan }}
                            </h2>

                            <small class="text-muted">
                                Total pengajuan
                            </small>
                        </div>

                        <div class="icon-box bg-primary-subtle text-primary">
                            <i class="bi bi-file-earmark-text fs-3"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Sedang Dipinjam --}}
        <div class="col-md-4">

            <div class="card border-0 shadow-sm dashboard-card">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between">

                        <div>
                            <p class="text-muted mb-2">
                                Sedang Dipinjam
                            </p>

                            <h2 class="fw-bold">
                                {{ $jumlahDipinjam }}
                            </h2>

                            <small class="text-muted">
                                Peminjaman aktif
                            </small>
                        </div>

                        <div class="icon-box bg-success-subtle text-success">
                            <i class="bi bi-box-seam fs-3"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>


        {{-- Menunggu Verifikasi --}}
        <div class="col-md-4">

            <div class="card border-0 shadow-sm dashboard-card">

                <div class="card-body p-4">

                    <div class="d-flex justify-content-between">

                        <div>
                            <p class="text-muted mb-2">
                                Menunggu Verifikasi
                            </p>

                            <h2 class="fw-bold">
                                {{ $jumlahVerifikasi }}
                            </h2>

                            <small class="text-muted">
                                Pengembalian
                            </small>
                        </div>

                        <div class="icon-box bg-warning-subtle text-warning">
                            <i class="bi bi-clock fs-3"></i>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    {{-- AKTIVITAS TERBARU --}}
    <div class="card border-0 shadow-sm">

        <div class="card-header bg-white border-0 p-4">

            <h5 class="fw-bold mb-1">
                <i class="bi bi-clock-history me-2 text-primary"></i>
                Aktivitas Peminjaman Saya
            </h5>

            <p class="text-muted mb-0">
                Status peminjaman terbaru kamu.
            </p>

        </div>


        <div class="card-body p-0">

            @if($peminjamanTerbaru->count() > 0)

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">

                            <tr>
                                <th class="px-4">Kode</th>
                                <th>Tanggal</th>
                                <th>Keperluan</th>
                                <th>Status</th>
                            </tr>

                        </thead>

                        <tbody>

                            @foreach($peminjamanTerbaru as $peminjaman)

                                <tr>

                                    {{-- KODE --}}
                                    <td class="px-4 fw-semibold">
                                        {{ $peminjaman->kode_pinjam }}
                                    </td>

                                    {{-- TANGGAL --}}
                                    <td>
                                        {{ $peminjaman->tgl_pinjam
                                            ? $peminjaman->tgl_pinjam->format('d/m/Y')
                                            : '-' }}
                                    </td>

                                    {{-- KEPERLUAN --}}
                                    <td>
                                        {{ $peminjaman->keperluan ?? '-' }}
                                    </td>

                                    {{-- STATUS --}}
                                    <td>

                                        @if($peminjaman->status == \App\Enums\StatusPeminjaman::Diajukan->value)

                                            <span class="badge bg-warning-subtle text-warning-emphasis">
                                                Menunggu Persetujuan
                                            </span>

                                        @elseif($peminjaman->status == \App\Enums\StatusPeminjaman::Dipinjam->value)

                                            <span class="badge bg-primary-subtle text-primary">
                                                Sedang Dipinjam
                                            </span>

                                        @elseif($peminjaman->status == \App\Enums\StatusPeminjaman::MenungguVerifikasi->value)

                                            <span class="badge bg-warning-subtle text-warning-emphasis">
                                                Menunggu Verifikasi
                                            </span>

                                        @elseif($peminjaman->status == \App\Enums\StatusPeminjaman::Selesai->value)

                                            <span class="badge bg-success-subtle text-success">
                                                Selesai
                                            </span>

                                        @elseif($peminjaman->status == \App\Enums\StatusPeminjaman::Ditolak->value)

                                            <span class="badge bg-danger-subtle text-danger">
                                                Ditolak
                                            </span>

                                        @else

                                            <span class="badge bg-secondary">
                                                {{ $peminjaman->status }}
                                            </span>

                                        @endif

                                    </td>

                                </tr>

                            @endforeach

                        </tbody>

                    </table>

                </div>

            @else

                <div class="text-center py-5">

                    <i class="bi bi-inbox fs-1 text-muted"></i>

                    <h6 class="mt-3">
                        Belum ada peminjaman
                    </h6>

                    <p class="text-muted">
                        Silakan pilih alat dari katalog untuk mengajukan peminjaman.
                    </p>

                </div>

            @endif

        </div>

    </div>

</div>


<style>

.dashboard-card {
    border-radius: 14px;
    transition: all 0.2s ease;
}

.dashboard-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.08) !important;
}

.icon-box {
    width: 55px;
    height: 55px;
    border-radius: 12px;

    display: flex;
    align-items: center;
    justify-content: center;
}

</style>

@endsection