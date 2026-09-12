<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>@yield('judul')</title>

    <style>
    body {
        font-family: 'DejaVu Sans', sans-serif;
        font-size: 8px;
        margin: 0;
    }

    h1 {
        text-align: center;
        font-size: 14px;
        margin: 0 0 5px;
    }

    h2 {
        margin: 0;
        font-size: 11px;
        text-align: center;
    }

    h3 {
        margin: 1px 0 0;
        font-size: 7px;
        font-weight: normal;
        text-align: center;
    }

    p {
        margin: 1px 0 4px;
        font-size: 6px;
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th,
    td {
        border: 1px solid #999;
        padding: 2px 3px;
        vertical-align: middle;
        line-height: 1.15;
    }

    th {
        background: #f2f2f2;
        font-size: 7px;
        text-align: left;
    }

    td {
        font-size: 7px;
    }

    .tengah {
        text-align: center;
    }

    .kanan {
        text-align: right;
    }

    /* KHUSUS RPT-01 */
    .tabel-peminjaman {
        table-layout: fixed;
    }

    .tabel-peminjaman .kol-no {
        width: 4%;
    }

    .tabel-peminjaman .kol-kode {
        width: 15%;
    }

    .tabel-peminjaman .kol-peminjam {
        width: 14%;
    }

    .tabel-peminjaman .kol-tgl {
        width: 11%;
    }

    .tabel-peminjaman .kol-kembali {
        width: 12%;
    }

    .tabel-peminjaman .kol-alat {
        width: 34%;
    }

    .tabel-peminjaman .kol-status {
        width: 10%;
    }

    .ringkasan {
        width: 35%;
        margin-left: auto;
        margin-top: 4px;
    }

    .ringkasan th {
        width: 75%;
    }

    .ringkasan td {
        width: 25%;
    }

    .pimpinan {
        margin-top: 15px;
        width: 45%;
        margin-left: auto;
    }

    .ttd {
        margin-top: 40px;
    }

    .catatan-bawah {
        position: fixed;
        bottom: 0;
        width: 100%;
        font-size: 6px;
        color: #555;
        border-top: 1px solid #ddd;
        padding-top: 3px;
    }
</style>
</head>

<body>

    <div class="kop">
        <h2>{{ $namaSekolah }}</h2>
        <h3>{{ $alamatSekolah ?? '' }}</h3>
        <p>Periode: {{ $keteranganPeriode }}</p>
    </div>

    <div class="isi">
        @yield('isi')
    </div>

    <div class="catatan-bawah">
        Dicetak pada {{ now()->format('d/m/Y H:i') }} oleh {{ auth()->user()->nama }}
    </div>

</body>
</html>
