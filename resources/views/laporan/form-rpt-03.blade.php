<div class="card h-100">
    <div class="card-header">RPT-03 - Rekapitulasi Stok Alat</div>

    <div class="card-body">
        <form method="GET"
              action="{{ route('laporan.stok') }}"
              target="_blank">

            <div class="mb-3">
                <label class="form-label small">Kategori</label>

                <select name="kategori_id"
                        class="form-select form-select-sm">

                    <option value="">Semua Kategori</option>

                    @foreach ($daftarKategori as $kategori)
                        <option value="{{ $kategori->id }}">
                            {{ $kategori->nama }}
                        </option>
                    @endforeach

                </select>
            </div>

            <div class="d-flex gap-2">

    <button type="submit"
            class="btn btn-primary flex-fill">
        Cetak PDF
    </button>

    <button type="submit"
            class="btn btn-success flex-fill"
            formaction="{{ route('laporan.stok.excel') }}"
            formtarget="_blank">
        Cetak Excel
    </button>

</div>

        </form>
    </div>
</div>
