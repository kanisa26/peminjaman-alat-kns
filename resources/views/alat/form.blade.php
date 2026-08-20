@extends('layouts.utama')

@section('judul', $alat->exists ? 'Ubah Alat' : 'Tambah Alat')

@section('konten')

    <div class="container d-flex justify-content-center">

        <div class="row w-100">
            <div class="col-lg-8 mx-auto">

                <div class="card">
                    <div class="card-body">

                        <h5 class="card-title mb-4">
                            {{ $alat->exists ? 'Ubah Data Alat' : 'Tambah Data Alat' }}
                        </h5>

                        <form
                            method="POST"
                            action="{{ $alat->exists ? route('alat.update', $alat) : route('alat.store') }}"
                            enctype="multipart/form-data"
                        >

                            @csrf

                            @if ($alat->exists)
                                @method('PUT')
                            @endif

                            <div class="row">

                                {{-- Kode Alat --}}
                                <div class="col-md-6">
                                    <x-input
                                        name="kode_alat"
                                        label="Kode Alat"
                                        :value="$alat->kode_alat"
                                    />
                                </div>

                                {{-- Nama Alat --}}
                                <div class="col-md-6">
                                    <x-input
                                        name="nama"
                                        label="Nama Alat"
                                        :value="$alat->nama"
                                    />
                                </div>

                                {{-- Kategori --}}
                                <div class="col-md-6">
                                    <x-select
                                        name="kategori_id"
                                        label="Kategori"
                                        :opsi="$daftarKategori"
                                        :value="$alat->kategori_id"
                                        key-value="id"
                                        key-label="nama"
                                        placeholder="Pilih kategori"
                                    />
                                </div>

                                {{-- Stok Total --}}
                                <div class="col-md-4">
                                    <x-input
                                        name="stok"
                                        label="Stok Total"
                                        :value="$alat->stok"
                                        type="number"
                                        min="0"
                                    />
                                </div>

                                {{-- Stok Tersedia --}}
                                <div class="col-md-4">
                                    <x-input
                                        name="stok_tersedia"
                                        label="Stok Tersedia"
                                        :value="$alat->stok_tersedia"
                                        type="number"
                                        min="0"
                                    />
                                </div>

                                {{-- Kondisi --}}
                                <div class="col-md-4">
                                    <x-select
                                        name="kondisi"
                                        label="Kondisi"
                                        :opsi="[
                                            ['key' => 'baik', 'label' => 'Baik'],
                                            ['key' => 'rusak_ringan', 'label' => 'Rusak Ringan'],
                                            ['key' => 'rusak_berat', 'label' => 'Rusak Berat'],
                                        ]"
                                        :value="$alat->kondisi"
                                        placeholder="Pilih kondisi"
                                    />
                                </div>

                                {{-- Deskripsi --}}
                                <div class="col-12">
                                    <x-textarea
                                        name="deskripsi"
                                        label="Deskripsi"
                                        rows="3"
                                        :value="$alat->deskripsi"
                                    />
                                </div>

                                {{-- Foto --}}
                                <div class="col-12">
                                    @include('alat.input-foto')
                                </div>

                                {{-- Tombol --}}
                                <div class="col-12 d-flex gap-2">
                                    <button
                                        type="submit"
                                        class="btn btn-primary"
                                    >
                                        Simpan
                                    </button>

                                    <a
                                        href="{{ route('alat.index') }}"
                                        class="btn btn-secondary"
                                    >
                                        Batal
                                    </a>
                                </div>

                            </div>

                        </form>

                    </div>
                </div>

            </div>
        </div>

    </div>

@endsection