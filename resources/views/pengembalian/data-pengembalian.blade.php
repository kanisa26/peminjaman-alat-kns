<div class="card">
    <div class="card-header">
        Data Pengembalian
    </div>

    <div class="card-body">

        <dl class="row mb-4">

            <dt class="col-sm-6">Peminjam</dt>
            <dd class="col-sm-6">
                {{ $peminjaman->peminjam->nama }}
            </dd>

            <dt class="col-sm-6">Harus Kembali</dt>
            <dd class="col-sm-6">
                {{ $peminjaman->tgl_harus_kembali->format('d/m/Y') }}
            </dd>

            <dt class="col-sm-6">Diajukan Kembali</dt>
            <dd class="col-sm-6">
                {{ $peminjaman->tgl_diajukan_kembali?->format('d/m/Y') ?? '-' }}
            </dd>

        </dl>

        <div class="form-text mb-2">
            Perubahan tanggal akan tercatat di log aktivitas.
        </div>

        <div class="mb-3">
            <label for="tgl_kembali" class="form-label">
                Tanggal Kembali
            </label>

            <input
                type="date"
                name="tgl_kembali"
                id="tgl_kembali"
                class="form-control"
                value="{{ old('tgl_kembali', $peminjaman->tgl_diajukan_kembali?->toDateString() ?? now()->toDateString()) }}"
                required
            >
        </div>

        <div class="form-text mb-2">
            Denda keterlambatan dihitung sistem, tidak perlu diisi di sini.
        </div>

        <div class="mb-3">
            <label for="denda_kerusakan" class="form-label">
                Denda Kerusakan
            </label>

            <input
                type="number"
                name="denda_kerusakan"
                id="denda_kerusakan"
                class="form-control"
                value="{{ old('denda_kerusakan', 0) }}"
                min="0"
                step="1000"
            >
        </div>

        <div class="mb-3">
            <label for="catatan" class="form-label">
                Catatan
            </label>

            <textarea
                name="catatan"
                id="catatan"
                class="form-control"
                rows="3"
            >{{ old('catatan') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success w-100">
            Simpan Verifikasi
        </button>

    </div>
</div>