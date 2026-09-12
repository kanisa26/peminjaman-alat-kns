<table class="table table-striped align-middle">
    <thead>
        <tr>
            <th>Kode Pinjam</th>
            <th>Peminjam</th>
            <th>Tenggat</th>
            <th>Status</th>
        </tr>
    </thead>

    <tbody>
        @forelse($daftarPeminjaman as $peminjaman)
            <tr class="{{ $peminjaman->tgl_harus_kembali < now()->startOfDay() ? 'table-warning' : '' }}">
                <td>{{ $peminjaman->kode_pinjam }}</td>

                <td>
                    {{ $peminjaman->peminjam->nama }}
                </td>

                <td>
                    {{ $peminjaman->tgl_harus_kembali->format('d/m/Y') }}

                    @if($peminjaman->tgl_harus_kembali < now()->startOfDay())
                        <span class="badge bg-danger">
                            Terlambat
                        </span>
                    @endif
                </td>

                <td>
                    <span class="badge bg-{{ $peminjaman->status->warna() }}">
                        {{ $peminjaman->status->value }}
                    </span>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center text-muted">
                    Tidak ada peminjaman yang sedang berjalan.
                </td>
            </tr>
        @endforelse
    </tbody>
</table>