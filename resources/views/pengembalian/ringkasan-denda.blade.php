<div class="card">

<div class="card-header">
    Ringkasan
</div>

<div class="card-body">

    <div class="row mb-2">
        <div class="col-5">
            <strong>Peminjam</strong>
        </div>

        <div class="col-7 text-end">
            {{ $pengembalian->peminjaman->peminjam->nama }}
        </div>
    </div>


    <div class="row mb-2">
        <div class="col-5">
            <strong>Tanggal Kembali</strong>
        </div>

        <div class="col-7 text-end">
            {{ $pengembalian->tgl_kembali->format('d/m/Y') }}
        </div>
    </div>


    <div class="row mb-2">
        <div class="col-5">
            <strong>Hari Terlambat</strong>
        </div>

        <div class="col-7 text-end">
            {{ $pengembalian->hari_terlambat }} hari
        </div>
    </div>


    <div class="row mb-2">
        <div class="col-5">
            <strong>Denda Keterlambatan</strong>
        </div>

        <div class="col-7 text-end">
            Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}
        </div>
    </div>


    <div class="row mb-3">
        <div class="col-5">
            <strong>Denda Kerusakan</strong>
        </div>

        <div class="col-7 text-end">
            Rp {{ number_format($pengembalian->denda_kerusakan, 0, ',', '.') }}
        </div>
    </div>

        <hr class="my-3">

    <div class="d-flex justify-content-between align-items-center">

        <strong>Total Denda</strong>

        <strong class="text-danger fs-4">
            Rp {{ number_format($pengembalian->total_denda, 0, ',', '.') }}
        </strong>

    </div>

    <hr class="my-3">

    @if($pengembalian->catatan)
        <div class="small text-muted">
            {{ $pengembalian->catatan }}
        </div>
    @endif

</div>

</div>


</div>

</div>
