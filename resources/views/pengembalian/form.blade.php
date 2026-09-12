
@extends('layouts.utama')

@section('judul', 'Verifikasi Pengembalian')

@section('konten')

<h4 class="mb-3">
    Verifikasi {{ $peminjaman->kode_pinjam }}
</h4>

<form method="POST"
      action="{{ route('pengembalian.simpan', $peminjaman) }}">

    @csrf

    <div class="row g-3">

        {{-- BAGIAN KIRI: KONDISI ALAT --}}
        <div class="col-lg-7">

            <div class="card h-100">

                <div class="card-header">
                    <strong>Kondisi Alat yang Dikembalikan</strong>
                </div>

                <div class="card-body">

                    <div class="table-responsive">

                        <table class="table table-bordered align-middle">

                            <thead>
                                <tr>
                                    <th>Kode</th>
                                    <th>Nama Alat</th>
                                    <th>Jumlah</th>
                                    <th>Kondisi Kembali</th>
                                </tr>
                            </thead>

                            <tbody>

                                @foreach($peminjaman->detail as $detail)

                                    <tr>

                                        <td>
                                            {{ $detail->alat->kode_alat }}
                                        </td>

                                        <td>
                                            {{ $detail->alat->nama }}
                                        </td>

                                        <td class="text-center">
                                            {{ $detail->jumlah }}
                                        </td>

                                        <td>

                                            <select
                                                name="kondisi[{{ $detail->id }}]"
                                                class="form-select"
                                                required>

                                                <option value="">
                                                    -- Pilih kondisi --
                                                </option>

                                                <option value="baik"
                                                    {{ old('kondisi.' . $detail->id) == 'baik' ? 'selected' : '' }}>
                                                    Baik
                                                </option>

                                                <option value="rusak_ringan"
                                                    {{ old('kondisi.' . $detail->id) == 'rusak_ringan' ? 'selected' : '' }}>
                                                    Rusak Ringan
                                                </option>

                                                <option value="rusak_berat"
                                                    {{ old('kondisi.' . $detail->id) == 'rusak_berat' ? 'selected' : '' }}>
                                                    Rusak Berat
                                                </option>

                                                <option value="hilang"
                                                    {{ old('kondisi.' . $detail->id) == 'hilang' ? 'selected' : '' }}>
                                                    Hilang
                                                </option>

                                            </select>

                                        </td>

                                    </tr>

                                @endforeach

                            </tbody>

                        </table>

                    </div>

                    <div class="alert alert-info mb-0">
                        Alat berkondisi <strong>baik</strong> dan
                        <strong>rusak ringan</strong> kembali menambah stok tersedia.
                        Alat berkondisi <strong>rusak berat</strong> dan
                        <strong>hilang</strong> mengurangi stok total.
                    </div>

                </div>

            </div>

        </div>


        {{-- BAGIAN KANAN: DATA PENGEMBALIAN --}}
        <div class="col-lg-5">

            <div class="card">

                <div class="card-header">
                    <strong>Data Pengembalian</strong>
                </div>

                <div class="card-body">

                    {{-- PEMINJAM --}}
                    <div class="row mb-2">

                        <div class="col-6">
                            <strong>Peminjam</strong>
                        </div>

                        <div class="col-6">
                            {{ $peminjaman->peminjam->nama }}
                        </div>

                    </div>


                    {{-- HARUS KEMBALI --}}
                    <div class="row mb-2">

                        <div class="col-6">
                            <strong>Harus Kembali</strong>
                        </div>

                        <div class="col-6">
                            {{ $peminjaman->tgl_harus_kembali->format('d/m/Y') }}
                        </div>

                    </div>


                    {{-- DIAJUKAN KEMBALI --}}
                    <div class="row mb-3">

                        <div class="col-6">
                            <strong>Diajukan Kembali</strong>
                        </div>

                        <div class="col-6">
                            {{ $peminjaman->tgl_diajukan_kembali?->format('d/m/Y') }}
                        </div>

                    </div>


                    {{-- INFO PERUBAHAN TANGGAL --}}
                    <div class="mb-2">

                        <div class="text-muted small">
                            Perubahan tanggal akan tercatat di log aktivitas.
                        </div>

                    </div>


                    {{-- TANGGAL KEMBALI --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Tanggal Kembali
                        </label>

                        <input
                            type="date"
                            name="tgl_kembali"
                            class="form-control"
                            value="{{ old('tgl_kembali', now()->format('Y-m-d')) }}"
                            required>

                    </div>


                    {{-- DENDA KETERLAMBATAN --}}
                    <div class="mb-3">

                        <div class="text-muted small"> Denda keterlambatan dihitung sistem, tidak perlu diisi di sini. </div>

                    </div>


                    {{-- DENDA KERUSAKAN --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Denda Kerusakan
                        </label>

                        <input
                            type="number"
                            name="denda_kerusakan"
                            class="form-control"
                            min="0"
                            value="{{ old('denda_kerusakan', 0) }}">

                    </div>


                    {{-- CATATAN --}}
                    <div class="mb-3">

                        <label class="form-label">
                            Catatan
                        </label>

                        <textarea
                            name="catatan"
                            class="form-control"
                            rows="3">{{ old('catatan') }}</textarea>

                    </div>


                    {{-- TOMBOL --}}
                    <div class="d-grid">

                        <button
                            type="submit"
                            class="btn btn-success">

                            Simpan Verifikasi

                        </button>

                    </div>

                </div>

            </div>

        </div>

    </div>

</form>

@endsection

