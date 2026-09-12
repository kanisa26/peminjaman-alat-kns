<div class="card h-100">
    <div class="card-header">RPT-01 - Laporan Peminjaman</div>

    <div class="card-body">
        <form method="GET"
              action="{{ route('laporan.peminjaman') }}"
              target="_blank"
              onsubmit="return cekTanggalRPT1()">

            <div class="mb-2">
                <label class="form-label small">Tanggal Awal</label>

                <input type="date"
                       name="tgl_awal"
                       id="tgl_awal_rpt1"
                       class="form-control form-control-sm"
                       value="{{ now()->toDateString() }}"
                       required
                       onchange="cekTanggalRPT1()">
            </div>

            <div class="mb-2">
                <label class="form-label small">Tanggal Akhir</label>

                <input type="date"
                       name="tgl_akhir"
                       id="tgl_akhir_rpt1"
                       class="form-control form-control-sm"
                       value="{{ now()->toDateString() }}"
                       required
                       onchange="cekTanggalRPT1()">
            </div>

            <div class="mb-3">
                <label class="form-label small">Status</label>

                <select name="status" class="form-select form-select-sm">
                    <option value="">Semua Status</option>

                    @foreach (App\Enums\StatusPeminjaman::cases() as $status)
                        <option value="{{ $status->value }}">
                            {{ $status->label() }}
                        </option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary w-100">
                Cetak PDF
            </button>

        </form>
    </div>
</div>

<script>
function cekTanggalRPT1() {

    const awal = document.getElementById('tgl_awal_rpt1').value;
    const akhir = document.getElementById('tgl_akhir_rpt1').value;

    if (awal && akhir && awal > akhir) {

        Swal.fire({
            icon: 'warning',
            title: 'Tanggal Tidak Valid',
            text: 'Tanggal awal tidak boleh lebih setelah tanggal akhir.',
            confirmButtonText: 'OK',
            confirmButtonColor: '#6c63d9',
            allowOutsideClick: false
        }).then(() => {

            // Kembalikan tanggal ke tanggal hari ini
            const hariIni = new Date().toISOString().split('T')[0];

            document.getElementById('tgl_awal_rpt1').value = hariIni;
            document.getElementById('tgl_akhir_rpt1').value = hariIni;

        });

        return false;
    }

    return true;
}
</script>