@extends('layouts.utama')

@section('judul', 'Ajukan Peminjaman')

@section('konten')

    <h4 class="mb-3">Ajukan Peminjaman</h4>

    @if ($daftarTunggakan->isNotEmpty())
        <div class="alert alert-danger">
            <strong>Terdapat tunggakan yang belum dikembalikan.</strong>

            <p class="mb-1 mt-2">
                Anda masih memiliki pinjaman yang lewat tenggat:
            </p>

            <ul class="mb-0">
                @foreach ($daftarTunggakan as $tunggakan)
                    <li>
                        {{ $tunggakan->kode_pinjam }}
                        — jatuh tempo
                        {{ $tunggakan->tgl_harus_kembali->format('d/m/Y') }}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row">

    <!-- KIRI -->
    <div class="col-md-7 mb-3">
        @include('peminjaman.alat-diajukan')
    </div>

    <!-- KANAN -->
    <div class="col-md-5">
        @include('peminjaman.data-peminjam')
    </div>

</div>

@endsection