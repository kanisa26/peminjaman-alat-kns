<div class="card">
    <div class="card-header">
        Kondisi Alat yang Dikembalikan
    </div>

    <div class="card-body p-0">
        <table class="table table-bordered mb-0">
            <thead>
                <tr>
                    <th>Nama Alat</th>
                    <th class="text-center">Jumlah</th>
                    <th>Kondisi Kembali</th>
                </tr>
            </thead>

            <tbody>
                @foreach($peminjaman->detail as $baris)
                    <tr>
                        <td>{{ $baris->alat->nama }}</td>

                        <td class="text-center">
                            {{ $baris->jumlah }}
                        </td>

                        <td>
                            <select
                                name="kondisi[{{ $baris->id }}]"
                                class="form-select"
                                required
                            >
                                <option value="">-- Pilih kondisi --</option>
                                <option value="baik">Baik</option>
                                <option value="rusak_ringan">Rusak Ringan</option>
                                <option value="rusak_berat">Rusak Berat</option>
                                <option value="hilang">Hilang</option>
                            </select>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>