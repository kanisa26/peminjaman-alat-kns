@extends('layouts.utama')

@section('judul', $alat->exists ? 'Ubah Alat' : 'Tambah Alat')

@section('konten')

<style>
    .form-page {
        padding: 0;
    }

    /* HEADER */
    .form-header {
        margin-bottom: 16px;
    }

    .form-header h4 {
        margin: 0;
        font-size: 24px;
        font-weight: 700;
        color: #1f2937;
    }

    .form-header p {
        margin: 3px 0 0;
        font-size: 13px;
        color: #6b7280;
    }

    /* CARD */
    .form-card {
        max-width: 900px;
        margin: 0 auto;
        border: none;
        border-radius: 14px;
        background: #fff;
        box-shadow: 0 4px 18px rgba(15, 23, 42, .06);
        overflow: hidden;
    }

    .form-card-header {
        padding: 17px 22px;
        border-bottom: 1px solid #edf0f3;
    }

    .form-card-header h5 {
        margin: 0;
        font-size: 16px;
        font-weight: 700;
        color: #1f2937;
    }

    .form-card-header p {
        margin: 3px 0 0;
        font-size: 12px;
        color: #9ca3af;
    }

    .form-card-body {
        padding: 20px 22px;
    }

    /* SECTION */
    .form-section {
        margin-bottom: 17px;
    }

    .form-section-title {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 11px;
        padding-bottom: 8px;
        border-bottom: 1px solid #eef2f7;
    }

    .form-section-title span {
        width: 24px;
        height: 24px;
        border-radius: 7px;
        background: #eff6ff;
        color: #2563eb;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        font-weight: 700;
    }

    .form-section-title h6 {
        margin: 0;
        font-size: 13px;
        font-weight: 700;
        color: #374151;
    }

    /* INPUT */
    .form-card-body .form-control,
    .form-card-body .form-select {
        min-height: 40px;
        border-radius: 8px;
        border: 1px solid #dfe3e8;
        font-size: 13px;
    }

    .form-card-body .form-control:focus,
    .form-card-body .form-select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 3px rgba(13, 110, 253, .08);
    }

    .form-card-body textarea.form-control {
        min-height: 75px;
    }

    /* LABEL */
    .form-card-body label {
        font-size: 12px;
        font-weight: 600;
        color: #374151;
        margin-bottom: 5px;
    }

    /* ROW */
    .form-card-body .row {
        --bs-gutter-x: 14px;
        --bs-gutter-y: 10px;
    }

    /* FOTO */
    .foto-box {
        padding: 11px;
        background: #f8fafc;
        border: 1px dashed #cbd5e1;
        border-radius: 9px;
    }

    /* ACTION */
    .form-actions {
        display: flex;
        gap: 8px;
        padding-top: 15px;
        margin-top: 3px;
        border-top: 1px solid #edf0f3;
    }

    .form-actions .btn {
        min-height: 39px;
        padding: 7px 17px;
        border-radius: 8px;
        font-size: 13px;
        font-weight: 600;
    }

    .btn-simpan {
        transition: .2s ease;
    }

    .btn-simpan:hover {
        transform: translateY(-1px);
        box-shadow: 0 5px 12px rgba(13, 110, 253, .16);
    }

    .btn-batal {
        background: #f1f5f9;
        border: none;
        color: #475569;
    }

    .btn-batal:hover {
        background: #e2e8f0;
        color: #334155;
    }

    @media (max-width: 768px) {

        .form-card-body {
            padding: 16px;
        }

        .form-card-header {
            padding: 16px;
        }

        .form-actions {
            flex-direction: column;
        }

        .form-actions .btn {
            width: 100%;
        }
    }
</style>


    {{-- FORM CARD --}}
    <div class="form-card">

        {{-- CARD HEADER --}}
        <div class="form-card-header">

            <h5>
                {{ $alat->exists ? 'Ubah Data Alat' : 'Tambah Data Alat' }}
            </h5>

            <p>
                Lengkapi informasi alat di bawah ini.
            </p>

        </div>


        <div class="form-card-body">

            <form
                method="POST"
                action="{{ $alat->exists
                    ? route('alat.update', $alat)
                    : route('alat.store') }}"
                enctype="multipart/form-data"
            >

                @csrf

                @if ($alat->exists)
                    @method('PUT')
                @endif


                {{-- INFORMASI ALAT --}}
                <div class="form-section">

                    <div class="form-section-title">

                        <span>01</span>

                        <h6>Informasi Alat</h6>

                    </div>


                    <div class="row">

                        <div class="col-md-6">

                            <x-input
                                name="kode_alat"
                                label="Kode Alat"
                                :value="$alat->kode_alat"
                            />

                        </div>


                        <div class="col-md-6">

                            <x-input
                                name="nama"
                                label="Nama Alat"
                                :value="$alat->nama"
                            />

                        </div>


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


                        <div class="col-md-6">

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

                    </div>

                </div>


                {{-- STOK --}}
                <div class="form-section">

                    <div class="form-section-title">

                        <span>02</span>

                        <h6>Stok Alat</h6>

                    </div>


                    <div class="row">

                        <div class="col-md-6">

                            <x-input
                                name="stok"
                                label="Stok Total"
                                :value="$alat->stok"
                                type="number"
                                min="0"
                            />

                        </div>


                        <div class="col-md-6">

                            <x-input
                                name="stok_tersedia"
                                label="Stok Tersedia"
                                :value="$alat->stok_tersedia"
                                type="number"
                                min="0"
                            />

                        </div>

                    </div>

                </div>


                {{-- DESKRIPSI --}}
                <div class="form-section">

                    <div class="form-section-title">

                        <span>03</span>

                        <h6>Deskripsi</h6>

                    </div>


                    <div class="row">

                        <div class="col-12">

                            <x-textarea
                                name="Deskripsi"
                                label="Deskripsi"
                                rows="2"
                                :value="$alat->deskripsi"
                            />

                        </div>

                    </div>

                </div>


                {{-- FOTO --}}
                <div class="form-section">

                    <div class="form-section-title">

                        <span>04</span>

                        <h6>Foto Alat</h6>

                    </div>


                    <div class="foto-box">

                        @include('alat.input-foto')

                    </div>

                </div>


                {{-- BUTTON --}}
                <div class="form-actions">

                    <button
                        type="submit"
                        class="btn btn-primary btn-simpan"
                    >
                        {{ $alat->exists ? 'Simpan Perubahan' : 'Simpan Alat' }}
                    </button>


                    <a
                        href="{{ route('alat.index') }}"
                        class="btn btn-batal"
                    >
                        Batal
                    </a>

                </div>

            </form>

        </div>

    </div>

</div>

@endsection