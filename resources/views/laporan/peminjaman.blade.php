@extends('laporan.layout')

@section('judul', 'Laporan Peminjaman Alat')

@section('isi')
    <table class="tabel-peminjaman">
    <thead>
        <tr>
            <th class="kol-no">No</th>
            <th class="kol-kode">Kode Pinjaman</th>
            <th class="kol-peminjam">Peminjam</th>
            <th class="kol-tgl">Tgl Pinjam</th>
            <th class="kol-kembali">Harus Kembali</th>
            <th class="kol-alat">Alat yang Dipinjam</th>
            <th class="kol-status">Status</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($daftarPeminjaman as $nomor => $peminjaman)
            <tr>
                <td class="tengah">
                    {{ $nomor + 1 }}
                </td>

                <td>
                    {{ $peminjaman->kode_pinjam }}
                </td>

                <td>
                    {{ $peminjaman->peminjam->nama ?? '-' }}
                </td>

                <td>
                    {{ $peminjaman->tgl_pinjam?->format('d/m/Y') }}
                </td>

                <td>
                    {{ $peminjaman->tgl_harus_kembali?->format('d/m/Y') }}
                </td>

                <td>
                    @foreach ($peminjaman->detail as $detail)
                        {{ $detail->alat->nama ?? '-' }}
                        ({{ $detail->jumlah }})@if (!$loop->last), @endif
                    @endforeach
                </td>

                <td>
                    {{ $peminjaman->status->label() }}
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7" class="tengah">
                    Tidak ada data pada periode ini.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>

<table class="ringkasan">
    <tr>
        <th>Jumlah Transaksi</th>
        <td class="kanan">{{ $daftarPeminjaman->count() }}</td>
    </tr>
</table>
</div>
    </div>
@endsection