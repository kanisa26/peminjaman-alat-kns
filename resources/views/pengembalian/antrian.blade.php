@extends('layouts.utama')

@section('judul', 'Antrian Verifikasi Pengembalian')

@section('konten')

<h4 class="mb-3">Antrian Verifikasi Pengembalian</h4>

<div class="card">
    <div class="card-body">

        <div class="table-responsive">

            <table class="table table-striped align-middle">
                <thead>
                    <tr>
                        <th>Kode Pinjam</th>
                        <th>Peminjam</th>
                        <th>Diajukan Kembali</th>
                        <th>Alat</th>
                        <th>Jumlah Alat</th>
                        <th>Aksi</th>
                    </tr>
                </thead>

                <tbody>
                    @forelse($daftarAntrian as $peminjaman)

                        <tr>
                            <td>
                                {{ $peminjaman->kode_pinjam }}
                            </td>

                            <td>
                                {{ $peminjaman->peminjam->nama }}
                            </td>

                            <td>
                                {{ $peminjaman->tgl_diajukan_kembali?->format('d/m/Y') }}
                            </td>

                            <td>
                                @foreach($peminjaman->detail as $detail)
                                    <div>
                                        {{ $detail->alat->nama }}
                                    </div>
                                @endforeach
                            </td>

                            <td>
                                @foreach($peminjaman->detail as $detail)
                                    <div>
                                        {{ $detail->jumlah }}
                                    </div>
                                @endforeach
                            </td>

                            <td>
                                <a href="{{ route('pengembalian.verifikasi', $peminjaman) }}"
                                   class="btn btn-sm btn-primary">
                                    Verifikasi
                                </a>
                            </td>
                        </tr>

                    @empty

                        <tr>
                            <td colspan="6" class="text-center text-muted">
                                Tidak ada pengembalian yang menunggu verifikasi.
                            </td>
                        </tr>

                    @endforelse
                </tbody>
            </table>

        </div>

        {{ $daftarAntrian->links() }}

    </div>
</div>

@endsection