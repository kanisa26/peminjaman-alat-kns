<table class="table table-striped align-middle">

    <thead>
        <tr>
            <th>Kode Pinjam</th>
            <th>Tanggal Pinjam</th>
            <th>Harus Kembali</th>
            <th class="text-center">Jumlah Alat</th>
            <th>Status</th>
            <th style="width: 100px">Aksi</th>
        </tr>
    </thead>

    <tbody>

        @forelse ($daftarPeminjaman as $peminjaman)

            <tr>

                <td>
                    {{ $peminjaman->kode_pinjam }}
                </td>

                <td>
                    {{ $peminjaman->tgl_pinjam->format('d/m/Y') }}
                </td>

                <td>
                    {{ $peminjaman->tgl_harus_kembali->format('d/m/Y') }}

                    @if ($peminjaman->lewatTenggat())
                        <span class="badge bg-danger">
                            Lewat tenggat
                        </span>
                    @endif
                </td>

                <td class="text-center">
                    {{ $peminjaman->detail->count() }}
                </td>

                <td>
                    <span class="badge bg-{{ $peminjaman->status->warna() }}">
                        {{ $peminjaman->status->label() }}
                    </span>
                </td>

                <td>
                    <a
                        href="{{ route('peminjaman.rincian', $peminjaman) }}"
                        class="btn btn-sm btn-outline-primary"
                    >
                        Rincian
                    </a>
                </td>

            </tr>

        @empty

            <tr>
                <td colspan="6" class="text-center text-muted">
                    Belum ada pengajuan peminjaman.
                </td>
            </tr>

        @endforelse

    </tbody>

</table>