@extends('layouts.utama')

@section('judul', $kategori->exists ? 'Ubah Kategori' : 'Tambah Kategori')

@section('konten')

<div class="row justify-content-center">

    <div class="col-md-8">

        <div class="card">

            <div class="card-body">

                <h5 class="card-title mb-4">
                    {{ $kategori->exists ? 'Ubah Kategori' : 'Tambah Kategori' }}
                </h5>

                <form
                    method="POST"
                    action="{{ $kategori->exists
                        ? route('kategori.update', $kategori)
                        : route('kategori.store') }}"
                >

                    @csrf

                    @if ($kategori->exists)
                        @method('PUT')
                    @endif


                    {{-- NAMA KATEGORI --}}
                    <div class="mb-3">

                        <label for="nama" class="form-label">
                            Nama Kategori
                        </label>

                        <input
                            type="text"
                            name="nama"
                            id="nama"
                            class="form-control"
                            value="{{ old('nama', $kategori->nama) }}"
                        >

                        @error('nama')
                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- DESKRIPSI KATEGORI --}}
                    <div class="mb-3">

                        <label for="deskripsi" class="form-label">
                            Deskripsi Kategori
                        </label>

                        <textarea
                            name="deskripsi"
                            id="deskripsi"
                            class="form-control"
                            rows="4"
                        >{{ old('deskripsi', $kategori->deskripsi) }}</textarea>

                        @error('deskripsi')
                            <div class="text-danger small mt-1">
                                {{ $message }}
                            </div>
                        @enderror

                    </div>


                    {{-- KETERANGAN --}}
                    <div class="small text-muted mb-3">
                        <span class="text-danger">*</span>
                        Wajib diisi
                    </div>


                    {{-- BUTTON --}}
                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Simpan
                    </button>

                    <a
                        href="{{ route('kategori.index') }}"
                        class="btn btn-secondary"
                    >
                        Batal
                    </a>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection