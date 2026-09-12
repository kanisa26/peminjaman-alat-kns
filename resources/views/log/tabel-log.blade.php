<table class="table table-striped align-middle">
    <thead>
        <tr>
            <th style="width: 15%;">Waktu</th>
            <th style="width: 15%;">Pengguna</th>
            <th style="width: 15%;">Aksi</th>
            <th style="width: 15%;">Tabel</th>
            <th style="width: 12%;">Alamat IP</th>
            <th>Deskripsi</th>
        </tr>
    </thead>

    <tbody>
        @forelse ($daftarLog as $log)

            @php
                $aksi = strtolower($log->aksi ?? 'aktivitas');

                $namaAksi = match ($aksi) {
                    'create' => 'create',
                    'update' => 'ubah',
                    'ubah' => 'ubah',
                    'delete' => 'delete',
                    'login' => 'login',
                    'logout' => 'logout',
                    'validasi' => 'validasi',
                    'beri_peran' => 'beri peran',
                    'login_gagal' => 'login gagal',
                    default => str_replace('_', ' ', $aksi),
                };
            @endphp

            <tr>

                {{-- WAKTU --}}
                <td class="small">
                    {{ $log->created_at?->format('d/m/Y H:i') }}
                </td>

                {{-- PENGGUNA --}}
                <td>
                    {{ $log->pengguna?->nama ?? 'Tidak dikenal' }}
                </td>

                {{-- AKSI --}}
                <td>
                    <span class="badge badge-aksi badge-{{ $aksi }}">
                        {{ $namaAksi }}
                    </span>
                </td>

                {{-- TABEL --}}
                <td class="small">
                    {{ $log->tabel_tujuan ?? '-' }}
                </td>

                {{-- IP --}}
                <td class="small">
                    {{ $log->ip_address ?? '-' }}
                </td>

                {{-- DESKRIPSI --}}
                <td class="small">
                    {{ $log->deskripsi }}
                </td>

            </tr>

        @empty

            <tr>
                <td colspan="6" class="text-center text-muted">
                    Tidak ada catatan aktivitas.
                </td>
            </tr>

        @endforelse
    </tbody>
</table>


<style>

/* ========================================
   BADGE AKSI
======================================== */

.badge-aksi {
    display: inline-block;
    font-size: 12px;
    font-weight: 600;
    padding: 4px 8px;
    border-radius: 6px;
    text-transform: lowercase;
}


/* CREATE - HIJAU */
.badge-create {
    background: #d1fae5 !important;
    color: #047857 !important;
}


/* UPDATE / UBAH - KUNING */
.badge-update,
.badge-ubah {
    background: #fef3c7 !important;
    color: #b45309 !important;
}


/* DELETE - MERAH */
.badge-delete {
    background: #fee2e2 !important;
    color: #dc2626 !important;
}


/* LOGIN - BIRU */
.badge-login {
    background: #dbeafe !important;
    color: #1d4ed8 !important;
}


/* LOGOUT - ABU */
.badge-logout {
    background: #e5e7eb !important;
    color: #4b5563 !important;
}


/* VALIDASI - UNGU */
.badge-validasi {
    background: #ede9fe !important;
    color: #6d28d9 !important;
}


/* BERI PERAN - UNGU */
.badge-beri_peran {
    background: #f3e8ff !important;
    color: #7e22ce !important;
}


/* LOGIN GAGAL - MERAH MUDA */
.badge-login_gagal {
    background: #fee2e2 !important;
    color: #b91c1c !important;
}


/* AKTIVITAS LAINNYA */
.badge-aktivitas {
    background: #f3f4f6 !important;
    color: #374151 !important;
}

</style>