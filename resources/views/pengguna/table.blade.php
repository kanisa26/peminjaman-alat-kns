<table class="table pengguna-table align-middle">

    <thead>

        <tr>

            <th style="width: 60px;">
                No
            </th>

            <th>
                Nama
            </th>

            <th>
                Nama Pengguna
            </th>

            <th>
                Peran
            </th>

            <th>
                Telepon
            </th>

            <th>
                Status
            </th>

            <th class="text-center" style="width: 150px;">
                Aksi
            </th>

        </tr>

    </thead>


    <tbody>

        @forelse ($daftarPengguna as $nomor => $pengguna)

            <tr>

                {{-- NO --}}
                <td>
                    {{ $daftarPengguna->firstItem() + $nomor }}
                </td>


                {{-- NAMA --}}
                <td>
                    <span class="nama-pengguna">
                        {{ $pengguna->nama }}
                    </span>
                </td>


                {{-- USERNAME --}}
                <td>
                    <span class="username-pengguna">
                        {{ $pengguna->username }}
                    </span>
                </td>


                {{-- PERAN --}}
                <td>

                    @foreach ($pengguna->roles as $peranPengguna)

                        <span class="badge-peran">
                            {{ ucfirst($peranPengguna->name) }}
                        </span>

                    @endforeach

                </td>


                {{-- TELEPON --}}
                <td>

                    <span class="telepon-pengguna">
                        {{ $pengguna->no_telp ?? '-' }}
                    </span>

                </td>


                {{-- STATUS --}}
<td>

    @if ($pengguna->status_validasi === 'menunggu')

        <span class="badge-status status-menunggu">
            Menunggu Validasi
        </span>

    @elseif ($pengguna->is_aktif)

        <span class="badge-status status-aktif">
            Aktif
        </span>

    @else

        <span class="badge-status status-nonaktif">
            Nonaktif
        </span>

    @endif

</td>


                {{-- AKSI --}}
                <td class="text-center aksi-pengguna">

                    @php

                        $hapus = $pengguna->id !== auth()->id()
                            ? route('pengguna.destroy', $pengguna)
                            : null;

                    @endphp


                    <x-tombol-aksi

                        :ubah="route('pengguna.edit', $pengguna)"

                        :hapus="$hapus"

                        :pesan-hapus="'Yakin ingin menghapus pengguna ' . $pengguna->nama . '?'"

                    />

                </td>

            </tr>


        @empty

            <tr>

                <td
                    colspan="7"
                    class="text-center text-muted py-5"
                >
                    Data pengguna tidak ditemukan.
                </td>

            </tr>

        @endforelse

    </tbody>

</table>