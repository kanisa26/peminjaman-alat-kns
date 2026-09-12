@extends('layouts.utama')

@section('judul', 'Daftar Pengguna')

@section('konten')

<style>
    .pengguna-page {
        padding: 5px 0 20px;
    }

    .pengguna-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 22px;
        gap: 15px;
    }

    .pengguna-header-title h4 {
        margin: 0;
        font-size: 25px;
        font-weight: 700;
        color: #1f2937;
    }

    .pengguna-header-title p {
        margin: 5px 0 0;
        color: #6b7280;
        font-size: 14px;
    }

    .btn-tambah-pengguna {
        border: none;
        border-radius: 10px;
        padding: 10px 17px;
        font-weight: 600;
        transition: all .2s ease;
    }

    .btn-tambah-pengguna:hover {
        transform: translateY(-2px);
        box-shadow: 0 7px 15px rgba(0, 0, 0, .10);
    }

    .pengguna-card {
        border: none;
        border-radius: 16px;
        background: #fff;
        box-shadow: 0 5px 20px rgba(15, 23, 42, .06);
        overflow: hidden;
    }

    .filter-box-pengguna {
        background: #f8fafc;
        border-radius: 12px;
        padding: 15px;
        margin: 20px 22px 18px;
        border: 1px solid #eef2f7;
    }

    .filter-box-pengguna form {
        margin-bottom: 0 !important;
    }

    .filter-box-pengguna .form-control,
    .filter-box-pengguna .form-select {
        border-radius: 9px;
        border: 1px solid #dfe3e8;
        min-height: 42px;
        font-size: 14px;
    }

    .filter-box-pengguna .form-control:focus,
    .filter-box-pengguna .form-select:focus {
        box-shadow: 0 0 0 3px rgba(13, 110, 253, .10);
        border-color: #86b7fe;
    }

    .btn-filter-pengguna {
        min-height: 42px;
        border-radius: 9px;
        padding: 0 18px;
        font-weight: 600;
    }

    .table-wrapper-pengguna {
        padding: 0 22px;
    }

    .pengguna-table {
        margin-bottom: 0;
        vertical-align: middle;
    }

    .pengguna-table thead th {
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

    .pengguna-table tbody td {
        padding: 14px 12px;
        border-bottom: 1px solid #f1f5f9;
        color: #374151;
        font-size: 14px;
    }

    .pengguna-table tbody tr:hover {
        background: #f8fafc;
    }

    .nama-pengguna {
        font-weight: 600;
        color: #1f2937;
    }

    .username-pengguna {
        color: #64748b;
    }

    .badge-peran {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 7px;
        background: #cffafe;
        color: #0891b2;
        font-size: 12px;
        font-weight: 700;
    }

    .telepon-pengguna {
        color: #374151;
    }

    .badge-status {
        display: inline-block;
        padding: 5px 9px;
        border-radius: 7px;
        font-size: 12px;
        font-weight: 700;
    }

    .status-aktif {
        background: #dcfce7;
        color: #15803d;
    }

    .status-nonaktif {
        background: #fee2e2;
        color: #dc2626;
    }

    .aksi-pengguna {
        white-space: nowrap;
    }

    .pagination-wrapper-pengguna {
        padding: 18px 22px;
    }

    .pagination-wrapper-pengguna nav {
        display: flex;
        justify-content: center;
    }

    @media (max-width: 768px) {

        .pengguna-header {
            align-items: flex-start;
            flex-direction: column;
        }

        .pengguna-header .btn-tambah-pengguna {
            width: 100%;
        }

        .filter-box-pengguna {
            margin: 0 12px 15px;
        }

        .table-wrapper-pengguna {
            padding: 0 12px;
        }

        .pagination-wrapper-pengguna {
            padding-left: 12px;
            padding-right: 12px;
        }
    }
</style>


<div class="pengguna-page">

    {{-- HEADER --}}
    <div class="pengguna-header">

        <div class="pengguna-header-title">

            <h4>
                Daftar Pengguna
            </h4>

            <p>
                Kelola data pengguna yang telah disetujui dalam sistem.
            </p>

        </div>


        <a
            href="{{ route('pengguna.create') }}"
            class="btn btn-primary btn-tambah-pengguna"
        >
            + Tambah Pengguna
        </a>

    </div>


    {{-- CARD --}}
    <div class="pengguna-card">

        {{-- FILTER --}}
        <div class="filter-box-pengguna">

            @include('pengguna.form-pencarian')

        </div>


        {{-- TABLE --}}
        <div class="table-responsive table-wrapper-pengguna">

            @include('pengguna.table')

        </div>


        {{-- PAGINATION --}}
        @if ($daftarPengguna->hasPages())

            <div class="pagination-wrapper-pengguna">

                {{ $daftarPengguna->links() }}

            </div>

        @endif

    </div>

</div>

@endsection