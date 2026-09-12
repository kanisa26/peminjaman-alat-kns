@extends('layouts.utama')

@section('judul', 'Laporan')

@section('konten')
    <div class="row g-3">
        @if ($errors->any())
    <div class="alert alert-danger">
        {{ $errors->first() }}
    </div>
@endif

        <div class="col-md-4">
            @include('laporan.form-rpt-01')
        </div>

        <div class="col-md-4">
            @include('laporan.form-rpt-02')
        </div>

        <div class="col-md-4">
            @include('laporan.form-rpt-03')
        </div>

    </div>
@endsection

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>