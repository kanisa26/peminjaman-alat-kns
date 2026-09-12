@extends('layouts.utama')

@section('judul', 'Daftar Alat')

@section('konten')

<style>
    .alat-page {
        padding: 5px 0 20px;
    }

    /* HEADER */
    .alat-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 22px;
        gap: 15px;
    }

    .alat-header-title h4 {
        margin: 0;
        font-size: 25px;
        font-weight: 700;
        color: #1f2937;
    }

    .alat-header-title p {
        margin: 5px 0 0;
        color: #6b7280;
        font-size: 14px;
    }

    /* BUTTON TAMBAH */
    .btn-tambah-alat {
        border: none;
        border-radius: 10px;
        padding: 10px 17px;
        font-weight: 600;
        transition: all .2s ease;
    }

    .btn-tambah-alat:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 15px rgba(0, 0, 0, .10);
    }

    /* CARD */
    .alat-card {
        border: none;
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 5px 20px rgba(15, 23, 42, .06);
        overflow: hidden;
    }

    .alat-card-header {
        padding: 20px 22px 5px;
    }

    .alat-card-header h6 {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
        color: #1f2937;
    }

    .alat-card-header p {
        margin: 5px 0 15px;
        color: #9ca3af;
        font-size: 13px;
    }

    /* SEARCH */
    .filter-box {
        background: #f8fafc;
        border-radius: 12px;
        padding: 15px;
        margin: 0 22px 18px;
        border: 1px solid #eef2f7;
    }

    .filter-box form {
        margin-bottom: 0 !important;
    }

    .filter-box .form-control,
    .filter-box .form-select {
        border-radius: 9px;
        border: 1px solid #dfe3e8;
        min-height: 42px;
        font-size: 14px;
    }

    .filter-box .form-control:focus,
    .filter-box .form-select:focus {
        box-shadow: 0 0 0 3px rgba(13, 110, 253, .10);
        border-color: #86b7fe;
    }

    .btn-filter {
        min-height: 42px;
        border-radius: 9px;
        padding: 0 18px;
        font-weight: 600;
    }

    /* TABLE */
    .table-wrapper {
        padding: 0 22px;
    }

    .alat-table {
        margin-bottom: 0;
        vertical-align: middle;
    }

    .alat-table thead th {
        background: #f8fafc;
        color: #64748b;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .3px;
        border-bottom: 1px solid #e5e7eb;
        padding: 13px 12px;
        white-space: nowrap;
    }

    .alat-table tbody td {
        padding: 14px 12px;
        border-bottom: 1px solid #f1f5f9;
        color: #374151;
        font-size: 14px;
    }

    .alat-table tbody tr {
        transition: all .18s ease;
    }

    .alat-table tbody tr:hover {
        background: #f8fafc;
    }

    /* FOTO */
    .alat-foto {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        object-fit: cover;
        border: 1px solid #e5e7eb;
    }

    .foto-kosong {
        width: 48px;
        height: 48px;
        border-radius: 10px;
        background: #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #94a3b8;
        font-size: 18px;
    }

    /* KODE */
    .kode-alat {
        display: inline-block;
        background: #f1f5f9;
        color: #475569;
        padding: 5px 9px;
        border-radius: 7px;
        font-size: 12px;
        font-weight: 600;
    }

    .nama-alat {
        font-weight: 600;
        color: #1f2937;
    }

    /* STOK */
    .stok-angka {
        font-weight: 600;
        color: #374151;
    }

    .badge-tersedia {
        display: inline-block;
        min-width: 34px;
        padding: 5px 9px;
        border-radius: 7px;
        font-size: 12px;
        font-weight: 700;
    }

    .badge-ada {
        background: #dcfce7;
        color: #15803d;
    }

    .badge-habis {
        background: #f1f5f9;
        color: #64748b;
    }

    /* KONDISI */
    .badge-kondisi {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 7px;
        background: #eff6ff;
        color: #2563eb;
        font-size: 12px;
        font-weight: 600;
        text-transform: capitalize;
    }

    /* PAGINATION */
    .pagination-wrapper {
        padding: 18px 22px;
    }

    .pagination-wrapper nav {
        display: flex;
        justify-content: center;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {

        .alat-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .alat-header .btn-tambah-alat {
            width: 100%;
        }

        .filter-box {
            margin: 0 12px 15px;
        }

        .table-wrapper {
            padding: 0 12px;
        }

        .alat-card-header {
            padding-left: 12px;
            padding-right: 12px;
        }

        .pagination-wrapper {
            padding-left: 12px;
            padding-right: 12px;
        }
    }
</style>


<div class="alat-page">

    {{-- HEADER --}}
    <div class="alat-header">

        <div class="alat-header-title">
            <h4>Daftar Alat</h4>
            <p>Kelola data alat dan ketersediaan inventaris.</p>
        </div>

        <a
            href="{{ route('alat.create') }}"
            class="btn btn-primary btn-tambah-alat"
        >
            + Tambah Alat
        </a>

    </div>


    {{-- CARD --}}
    <div class="alat-card">


        {{-- FILTER --}}
        <div class="filter-box">
            @include('alat.form-pencarian')
        </div>


        {{-- TABLE --}}
        <div class="table-responsive table-wrapper">

            <table class="table alat-table align-middle">

                <thead>
                    <tr>

                        <th style="width: 70px;">
                            Foto
                        </th>

                        <th>
                            Kode
                        </th>

                        <th>
                            Nama Alat
                        </th>

                        <th>
                            Kategori
                        </th>

                        <th class="text-center">
                            Stok
                        </th>

                        <th class="text-center">
                            Tersedia
                        </th>

                        <th>
                            Kondisi
                        </th>

                        <th class="text-center" style="width: 150px;">
                            Aksi
                        </th>

                    </tr>
                </thead>


                <tbody>

                    @forelse ($daftarAlat as $alat)

                        <tr>

                            {{-- FOTO --}}
                            <td>
                                @if ($alat->foto)

                                    <img
                                        src="{{ asset('gambar/alat/' . $alat->foto) }}"
                                        alt="{{ $alat->nama }}"
                                        class="alat-foto"
                                    >

                                @else

                                    <div class="foto-kosong">
                                        —
                                    </div>

                                @endif
                            </td>


                            {{-- KODE --}}
                            <td>
                                <span class="kode-alat">
                                    {{ $alat->kode_alat }}
                                </span>
                            </td>


                            {{-- NAMA --}}
                            <td>
                                <span class="nama-alat">
                                    {{ $alat->nama }}
                                </span>
                            </td>


                            {{-- KATEGORI --}}
                            <td>
                                {{ $alat->kategori->nama }}
                            </td>


                            {{-- STOK --}}
                            <td class="text-center">
                                <span class="stok-angka">
                                    {{ $alat->stok }}
                                </span>
                            </td>


                            {{-- TERSEDIA --}}
                            <td class="text-center">

                                <span
                                    class="badge-tersedia
                                    {{ $alat->stok_tersedia > 0
                                        ? 'badge-ada'
                                        : 'badge-habis' }}"
                                >
                                    {{ $alat->stok_tersedia }}
                                </span>

                            </td>


                            {{-- KONDISI --}}
                            <td>

                                <span class="badge-kondisi">
                                    {{ str_replace('_', ' ', $alat->kondisi) }}
                                </span>

                            </td>


                            {{-- AKSI --}}
                            <td class="text-center">

                                <x-tombol-aksi
                                    :ubah="route('alat.edit', $alat)"
                                    :hapus="route('alat.destroy', $alat)"
                                    :pesan-hapus="'Hapus data alat ' . $alat->nama . '?'"
                                />

                            </td>

                        </tr>


                    @empty

                        <tr>

                            <td
                                colspan="8"
                                class="text-center text-muted py-5"
                            >
                                Belum ada data alat.
                            </td>

                        </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        {{-- PAGINATION --}}
        @if ($daftarAlat->hasPages())

            <div class="pagination-wrapper">
                {{ $daftarAlat->links() }}
            </div>

        @endif

    </div>

</div>

@endsection