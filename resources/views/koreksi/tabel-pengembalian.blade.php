<table class="table table-striped align-middle">

    <thead>
        <tr>
            <th>Kode Pinjam</th>
            <th>Peminjam</th>
            <th>Tanggal Kembali</th>
            <th class="text-end">Denda Keterlambatan</th>
            <th class="text-end">Denda Kerusakan</th>
            <th class="text-end">Total Denda</th>
            <th class="text-center">Status Pembayaran</th>
            <th class="text-center">Aksi</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($daftarPengembalian as $pengembalian)

            <tr>
                <td>
                    {{ $pengembalian->peminjaman->kode_pinjam }}
                </td>

                <td>
                    {{ $pengembalian->peminjaman->peminjam->nama }}
                </td>

                <td>
                    {{ $pengembalian->tgl_kembali->format('d/m/Y') }}
                </td>

                <td class="text-end">
                    Rp {{ number_format($pengembalian->denda, 0, ',', '.') }}
                </td>

                <td class="text-end">
                    Rp {{ number_format($pengembalian->denda_kerusakan, 0, ',', '.') }}
                </td>

                <td class="text-end">
                    Rp {{ number_format($pengembalian->total_denda, 0, ',', '.') }}
                </td>

                {{-- STATUS PEMBAYARAN --}}
<td class="text-center">

    @if ($pengembalian->total_denda <= 0)

        <span class="badge bg-secondary">
            Tidak Ada Denda
        </span>

    @elseif ($pengembalian->status_pembayaran === 'sudah_dibayar')

        <span class="badge bg-success">
            🟢 Sudah Dibayar
        </span>

    @else

        <span class="badge bg-danger">
            🔴 Belum Dibayar
        </span>

    @endif

</td>

                {{-- AKSI --}}
                <td class="text-center">

                    <div class="aksi-pengembalian">

                        <a href="{{ route('koreksi.pengembalian.ubah', $pengembalian) }}"
                           class="btn-aksi btn-ubah"
                           title="Ubah">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                 width="19"
                                 height="19"
                                 viewBox="0 0 24 24"
                                 fill="none"
                                 stroke="currentColor"
                                 stroke-width="2"
                                 stroke-linecap="round"
                                 stroke-linejoin="round">

                                <path d="M12 20h9"></path>
                                <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4Z"></path>

                            </svg>

                        </a>

                    </div>

                </td>
            </tr>

        @empty

            <tr>
                <td colspan="8" class="text-center text-muted">
                    Belum ada data pengembalian.
                </td>
            </tr>

        @endforelse
    </tbody>

</table>

<style>

    /* =========================
       AKSI PENGEMBALIAN
    ========================= */

    .aksi-pengembalian {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-aksi {
        width: 43px;
        height: 43px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        border-radius: 10px;
        background: white;

        transition: all 0.2s ease;
    }

    /* TOMBOL UBAH */

    .btn-ubah {
        color: #ffb000;
        border: 1px solid #ffb000;
        text-decoration: none;
    }

    .btn-ubah:hover {
        background: #fff8e1;
        color: #e09b00;
        transform: translateY(-1px);
    }

    /* =========================
       AKSI PENGEMBALIAN
    ========================= */

    .aksi-pengembalian {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
    }

    .btn-aksi {
        width: 43px;
        height: 43px;

        display: inline-flex;
        align-items: center;
        justify-content: center;

        border-radius: 10px;
        background: white;

        transition: all 0.2s ease;
    }

    /* TOMBOL UBAH */

    .btn-ubah {
        color: #ffb000;
        border: 1px solid #ffb000;
        text-decoration: none;
    }

    .btn-ubah:hover {
        background: #fff8e1;
        color: #e09b00;
        transform: translateY(-1px);
    }

</style>