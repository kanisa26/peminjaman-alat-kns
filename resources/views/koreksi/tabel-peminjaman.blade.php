<table class="table table-striped align-middle">

    <thead>
        <tr>
            <th>Kode Pinjam</th>
            <th>Peminjam</th>
            <th>Tanggal Pinjam</th>
            <th>Harus Kembali</th>
            <th>Status</th>
            <th class="text-center" style="width: 150px;">Aksi</th>
        </tr>
    </thead>

    <tbody>

        @forelse ($daftarPeminjaman as $peminjaman)

            <tr>

                <td>
                    {{ $peminjaman->kode_pinjam }}
                </td>

                <td>
                    {{ $peminjaman->peminjam->nama }}
                </td>

                <td>
                    {{ $peminjaman->tgl_pinjam->format('d/m/Y') }}
                </td>

                <td>
                    {{ $peminjaman->tgl_harus_kembali->format('d/m/Y') }}
                </td>

                {{-- STATUS --}}
                <td>

                    @php
                        $warnaStatus = match($peminjaman->status->label()) {
                            'Diajukan' => '#0d6efd',
                            'Dipinjam' => '#0d6efd',
                            'Menunggu Verifikasi' => '#12bfdc',
                            'Selesai' => '#198754',
                            'Ditolak' => '#dc3545',
                            default => '#6c757d',
                        };
                    @endphp

                    <span class="status-peminjaman"
                          style="background-color: {{ $warnaStatus }};">
                        {{ $peminjaman->status->label() }}
                    </span>

                </td>

                {{-- AKSI --}}
                <td class="text-center">

                    <div class="aksi-peminjaman">

                        {{-- UBAH --}}
                        <a href="{{ route('koreksi.peminjaman.ubah', $peminjaman) }}"
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


                        {{-- HAPUS --}}
                        @can('delete', $peminjaman)

                            <form method="POST"
                                  action="{{ route('koreksi.peminjaman.hapus', $peminjaman) }}"
                                  class="d-inline">

                                @csrf
                                @method('DELETE')

                                <button type="submit"
                                        class="btn-aksi btn-hapus"
                                        title="Hapus"
                                        onclick="return confirm('Hapus data peminjaman ini?')">

                                    <svg xmlns="http://www.w3.org/2000/svg"
                                         width="19"
                                         height="19"
                                         viewBox="0 0 24 24"
                                         fill="none"
                                         stroke="currentColor"
                                         stroke-width="2"
                                         stroke-linecap="round"
                                         stroke-linejoin="round">

                                        <polyline points="3 6 5 6 21 6"></polyline>
                                        <path d="M19 6l-1 14H6L5 6"></path>
                                        <path d="M10 11v6"></path>
                                        <path d="M14 11v6"></path>
                                        <path d="M9 6V4h6v2"></path>

                                    </svg>

                                </button>

                            </form>

                        @else

                            <button type="button"
                                    class="btn-aksi btn-hapus"
                                    title="Tidak dapat dihapus"
                                    disabled>

                                <svg xmlns="http://www.w3.org/2000/svg"
                                     width="19"
                                     height="19"
                                     viewBox="0 0 24 24"
                                     fill="none"
                                     stroke="currentColor"
                                     stroke-width="2"
                                     stroke-linecap="round"
                                     stroke-linejoin="round">

                                    <polyline points="3 6 5 6 21 6"></polyline>
                                    <path d="M19 6l-1 14H6L5 6"></path>
                                    <path d="M10 11v6"></path>
                                    <path d="M14 11v6"></path>
                                    <path d="M9 6V4h6v2"></path>

                                </svg>

                            </button>

                        @endcan

                    </div>

                </td>

            </tr>

        @empty

            <tr>
                <td colspan="6" class="text-center text-muted py-4">
                    Belum ada data peminjaman.
                </td>
            </tr>

        @endforelse

    </tbody>

</table>


<style>

    /* =========================
       STATUS
    ========================= */

    .status-peminjaman {
        display: inline-block;
        padding: 4px 9px;
        border-radius: 6px;
        color: white;
        font-size: 12px;
        font-weight: 600;
        line-height: 1.2;
        white-space: nowrap;
    }


    /* =========================
       AKSI
    ========================= */

    .aksi-peminjaman {
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


    /* TOMBOL HAPUS */

    .btn-hapus {
        color: #ff4d4d;
        border: 1px solid #ff8a8a;
    }

    .btn-hapus:hover:not(:disabled) {
        background: #fff1f1;
        color: #e53935;
        transform: translateY(-1px);
    }


    /* DISABLED */

    .btn-hapus:disabled {
        opacity: 0.45;
        cursor: not-allowed;
    }

</style>