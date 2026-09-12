@extends('layouts.utama')

@section('judul', 'Koreksi Pengembalian')

@section('konten')

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h4 class="mb-0">Koreksi {{ $pengembalian->peminjaman->kode_pinjam }}</h4>
    </div>

    <a href="{{ route('koreksi.pengembalian.daftar') }}"
       class="btn btn-outline-secondary">Kembali</a>
</div>

<div class="row">

    <div class="col-md-5 mb-3">
        <div class="card">

            <div class="card-header">
                Data yang Tidak Dapat Dikoreksi
            </div>

            <div class="card-body">

                <dl class="row small mb-0">

                    <dt class="col-5">Peminjam</dt>
                    <dd class="col-7">
                        {{ $pengembalian->peminjaman->peminjam->nama }}
                    </dd>

                    <dt class="col-5">Tanggal Kembali</dt>
                    <dd class="col-7">
                        {{ $pengembalian->tgl_kembali->format('d/m/Y') }}
                    </dd>

                    <dt class="col-5">Hari Terlambat</dt>
                    <dd class="col-7">
                        {{ $pengembalian->hari_terlambat }} hari
                    </dd>

                    <dt class="col-5">Denda Keterlambatan</dt>
                    <dd class="col-7">
                        Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}
                    </dd>

                    <dt class="col-5">Total Denda</dt>
                    <dd class="col-7">
                        Rp {{ number_format($pengembalian->total_denda, 0, ',', '.') }}
                    </dd>

                </dl>

                <hr>

                <div class="small text-muted">
                    Denda keterlambatan dan hari terlambat dikunci di trigger.
                    Total denda dihitung ulang sistem setiap kali disimpan.
                </div>

            </div>
        </div>
    </div>

    <div class="col-md-7">

        <div class="card">

            <div class="card-header">
                Isian yang Dapat Dikoreksi
            </div>

            <div class="card-body">

                <form method="POST"
                      action="{{ route('koreksi.pengembalian.perbarui', $pengembalian) }}">

                    @csrf
                    @method('PUT')

                    <x-input 
    label="Denda Kerusakan" 
    name="denda_kerusakan" 
    type="number" 
    :value="$pengembalian->denda_kerusakan" 
    required />

<div class="mb-3">

    <label for="status_pembayaran" class="form-label">
        Status Pembayaran
    </label>

    <select
        name="status_pembayaran"
        id="status_pembayaran"
        class="form-select"
        {{ $pengembalian->total_denda <= 0 ? 'disabled' : '' }}
    >

        <option value="belum_dibayar"
            {{ old('status_pembayaran', $pengembalian->status_pembayaran) == 'belum_dibayar' ? 'selected' : '' }}>
            Belum Dibayar
        </option>

        <option value="sudah_dibayar"
            {{ old('status_pembayaran', $pengembalian->status_pembayaran) == 'sudah_dibayar' ? 'selected' : '' }}>
            Sudah Dibayar
        </option>

    </select>

    @if($pengembalian->total_denda <= 0)
        <input type="hidden"
               name="status_pembayaran"
               value="belum_dibayar">

        <small class="text-muted">
            Status pembayaran tidak dapat diubah karena tidak ada denda.
        </small>
    @endif

</div>

<x-textarea 
    label="Catatan" 
    name="catatan" 
    :value="$pengembalian->catatan" />

                    <button type="submit" class="btn btn-primary">
                        Simpan Koreksi
                    </button>

                    <a href="{{ route('koreksi.pengembalian.daftar') }}"
                       class="btn btn-secondary">
                        Batal
                    </a>

                </form>

            </div>
        </div>

    </div>

</div>

@endsection