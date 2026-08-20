@extends('layouts.utama')

@section('judul', 'Daftar Kategori')

@section('konten')

    <div class="container">

        {{-- JUDUL + TOMBOL TAMBAH --}}
        <div class="d-flex justify-content-between align-items-center mb-3">

            <h4 class="mb-0">
                Daftar Kategori
            </h4>

            <a href="{{ route('kategori.create') }}"
               class="btn btn-primary">
                Tambah Kategori
            </a>

        </div>


        {{-- CARD --}}
        <div class="card">

            <div class="card-body">

                {{-- FORM PENCARIAN --}}
                <form action="{{ route('kategori.index') }}"
                      method="GET"
                      class="mb-3">

                    <div class="d-flex gap-2">

                        <input type="text"
                               name="cari"
                               class="form-control"
                               placeholder="Cari..."
                               value="{{ $kataKunci }}"
                               style="width: 300px;">

                        <button type="submit"
                                class="btn btn-primary">
                            Cari
                        </button>

                        <a href="{{ route('kategori.index') }}"
                           class="btn btn-secondary">
                            Reset
                        </a>

                    </div>

                </form>


                {{-- TABEL --}}
                <div class="table-responsive">

                    <table class="table table-striped align-middle">

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

                                <th style="width: 160px;">
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
                                        {{ $kategori->nama }}
                                    </td>


                                    {{-- DESKRIPSI --}}
                                    <td>
                                        {{ $kategori->deskripsi }}
                                    </td>


                                    {{-- JUMLAH ALAT --}}
                                    <td>
                                        {{ $kategori->alat_count }}
                                    </td>


                                    {{-- AKSI --}}
                                    <td>

                                        {{-- TOMBOL UBAH --}}
                                        <a href="{{ route('kategori.edit', $kategori) }}"
                                           class="btn btn-warning btn-sm">
                                            Ubah
                                        </a>


                                        {{-- TOMBOL HAPUS --}}
                                        <form action="{{ route('kategori.destroy', $kategori) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('Yakin ingin menghapus kategori {{ $kategori->nama }}?')">

                                            @csrf

                                            @method('DELETE')

                                            <button type="submit"
                                                    class="btn btn-danger btn-sm">
                                                Hapus
                                            </button>

                                        </form>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="5"
                                        class="text-center text-muted">

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