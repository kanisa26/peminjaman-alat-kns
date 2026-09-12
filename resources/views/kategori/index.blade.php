@extends('layouts.utama')

@section('judul', 'Daftar Kategori')

@section('konten')

<style>
    .kategori-container {
        padding: 10px 0 30px;
    }

    /* HEADER */
    .kategori-header {
        margin-bottom: 22px;
    }

    .kategori-header h4 {
        margin: 0;
        font-size: 26px;
        font-weight: 700;
        color: #1f2937;
    }

    .kategori-header p {
        margin: 5px 0 0;
        color: #6b7280;
        font-size: 14px;
    }

    /* CARD */
    .kategori-card {
        border: 1px solid #e5e7eb;
        border-radius: 10px;
        background: #ffffff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        overflow: hidden;
    }

    .kategori-card-body {
        padding: 18px;
    }

    /* SEARCH */
    .search-wrapper {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 20px;
    }

    .search-wrapper .form-control {
        width: 300px;
        height: 38px;
        border-radius: 7px;
        border: 1px solid #d1d5db;
        font-size: 14px;
    }

    .search-wrapper .form-control:focus {
        border-color: #0d6efd;
        box-shadow: 0 0 0 2px rgba(13, 110, 253, 0.10);
    }

    .btn-cari {
        height: 38px;
        border-radius: 7px;
        padding: 0 18px;
    }

    .btn-reset {
        height: 38px;
        border-radius: 7px;
        padding: 0 16px;
    }

    /* TABLE */
    .kategori-table {
        margin-bottom: 0;
    }

    .kategori-table thead th {
        background: #f8fafc;
        color: #111827;
        font-size: 14px;
        font-weight: 700;
        border-bottom: 1px solid #e5e7eb;
        padding: 14px 10px;
        white-space: nowrap;
    }

    .kategori-table tbody td {
        padding: 13px 10px;
        font-size: 14px;
        color: #374151;
        border-bottom: 1px solid #edf0f3;
        vertical-align: middle;
    }

    .kategori-table tbody tr {
        transition: all 0.2s ease;
    }

    .kategori-table tbody tr:hover {
        background: #f8fbff;
    }

    .kategori-nama {
        font-weight: 600;
        color: #1f2937;
    }

    .kategori-deskripsi {
        color: #6b7280;
    }

    /* JUMLAH ALAT */
    .jumlah-alat {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 34px;
        height: 28px;
        padding: 0 9px;
        border-radius: 20px;
        background: #e8f1ff;
        color: #0d6efd;
        font-weight: 600;
        font-size: 13px;
    }

    /* AKSI */
    .aksi-wrapper {
        display: flex;
        align-items: center;
        gap: 9px;
    }

    .btn-aksi {
        width: 42px;
        height: 42px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 9px;
        background: #ffffff;
        transition: all 0.2s ease;
        text-decoration: none;
        padding: 0;
    }

    /* TOMBOL UBAH */
    .btn-ubah {
        border: 1px solid #f6d365;
        color: #e9a900;
        background: #fff9df;
    }

    .btn-ubah:hover {
        color: #d99600;
        background: #fff3c2;
        border-color: #f1c84b;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(234, 179, 8, 0.15);
    }

    /* TOMBOL HAPUS */
    .btn-hapus {
        border: 1px solid #f3a4a4;
        color: #ef4444;
        background: #fff5f5;
        cursor: pointer;
    }

    .btn-hapus:hover {
        color: #dc2626;
        background: #ffe4e4;
        border-color: #ef8d8d;
        transform: translateY(-2px);
        box-shadow: 0 4px 10px rgba(239, 68, 68, 0.15);
    }

    .btn-aksi svg {
        width: 20px;
        height: 20px;
    }

    /* EMPTY */
    .data-kosong {
        padding: 35px !important;
        color: #9ca3af !important;
    }

    /* PAGINATION */
    .pagination {
        margin-top: 18px;
        margin-bottom: 0;
    }

    .btn-tambah-kategori {
    border-radius: 8px;
    padding: 10px 18px;
    font-size: 14px;
    font-weight: 500;
    transition: all 0.2s ease;
}

.btn-tambah-kategori:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 10px rgba(13, 110, 253, 0.20);
}
</style>


<div class="container kategori-container">

    {{-- HEADER --}}
    <div class="kategori-header d-flex justify-content-between align-items-center">

    <div>
        <h4>Daftar Kategori</h4>

        <p>
            Kelola kategori alat yang tersedia dalam sistem.
        </p>
    </div>

    {{-- TAMBAH KATEGORI --}}
    <a href="{{ route('kategori.create') }}"
       class="btn btn-primary btn-tambah-kategori">
        + Tambah Kategori
    </a>

</div>


    {{-- CARD --}}
    <div class="kategori-card">

        <div class="kategori-card-body">

            {{-- FORM PENCARIAN --}}
            <form action="{{ route('kategori.index') }}"
                  method="GET"
                  class="search-wrapper">

                <input type="text"
                       name="cari"
                       class="form-control"
                       placeholder="Cari kategori..."
                       value="{{ $kataKunci }}">

                <button type="submit"
                        class="btn btn-primary btn-cari">
                    Cari
                </button>

                <a href="{{ url('/kategori') }}"
                   class="btn btn-secondary btn-reset">
                    Reset
                </a>

            </form>


            {{-- TABEL --}}
            <div class="table-responsive">

                <table class="table kategori-table align-middle">

                    <thead>

                        <tr>

                            <th style="width: 60px;">
                                No
                            </th>

                            <th>
                                Nama
                            </th>

                            <th>
                                Deskripsi
                            </th>

                            <th style="width: 120px;">
                                Jumlah Alat
                            </th>

                            <th style="width: 130px;">
                                Aksi
                            </th>

                        </tr>

                    </thead>


                    <tbody>

                        @forelse($daftarKategori as $nomor => $kategori)

                            <tr>

                                {{-- NOMOR --}}
                                <td>
                                    {{ $daftarKategori->firstItem() + $nomor }}
                                </td>


                                {{-- NAMA --}}
                                <td>
                                    <span class="kategori-nama">
                                        {{ $kategori->nama }}
                                    </span>
                                </td>


                                {{-- DESKRIPSI --}}
                                <td>
                                    <span class="kategori-deskripsi">
                                        {{ $kategori->deskripsi ?: '-' }}
                                    </span>
                                </td>


                                {{-- JUMLAH ALAT --}}
                                <td>
                                    <span class="jumlah-alat">
                                        {{ $kategori->alat_count }}
                                    </span>
                                </td>


                                {{-- AKSI --}}
                                <td>

                                    <div class="aksi-wrapper">

                                        {{-- UBAH --}}
                                        <a href="{{ route('kategori.edit', $kategori) }}"
                                           class="btn-aksi btn-ubah"
                                           title="Ubah kategori"
                                           aria-label="Ubah kategori">

                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 24 24"
                                                 fill="none"
                                                 stroke="currentColor"
                                                 stroke-width="2"
                                                 stroke-linecap="round"
                                                 stroke-linejoin="round">

                                                <path d="M12 20h9"/>

                                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4Z"/>

                                            </svg>

                                        </a>


                                        {{-- HAPUS --}}
                                        <form action="{{ route('kategori.destroy', $kategori) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus kategori {{ $kategori->nama }}?')">

                                            @csrf
                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn-aksi btn-hapus"
                                                    title="Hapus kategori"
                                                    aria-label="Hapus kategori">

                                                <svg xmlns="http://www.w3.org/2000/svg"
                                                     viewBox="0 0 24 24"
                                                     fill="none"
                                                     stroke="currentColor"
                                                     stroke-width="2"
                                                     stroke-linecap="round"
                                                     stroke-linejoin="round">

                                                    <path d="M3 6h18"/>

                                                    <path d="M8 6V4h8v2"/>

                                                    <path d="M19 6l-1 14H6L5 6"/>

                                                    <path d="M10 11v5"/>

                                                    <path d="M14 11v5"/>

                                                </svg>

                                            </button>

                                        </form>

                                    </div>

                                </td>

                            </tr>

                        @empty

                            <tr>

                                <td colspan="5"
                                    class="text-center data-kosong">

                                    Belum ada data kategori.

                                </td>

                            </tr>

                        @endforelse

                    </tbody>

                </table>

            </div>


            {{-- PAGINATION --}}
            {{ $daftarKategori->links() }}

        </div>

    </div>

</div>

@endsection