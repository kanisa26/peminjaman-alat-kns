<div class="card h-100">
    <div class="card-header">RPT-02 - Laporan Pengembalian & Denda</div>

    <div class="card-body">
        <form method="GET"
              action="{{ route('laporan.pengembalian') }}"
              target="_blank"
              onsubmit="return cekTanggalRPT2()">

            <div class="mb-2">
                <label class="form-label small">Tanggal Awal</label>

                <input type="date"
                       name="tgl_awal"
                       id="tgl_awal_rpt2"
                       class="form-control form-control-sm"
                       value="{{ now()->toDateString() }}"
                       required
                       onchange="cekTanggalRPT2()">
            </div>

            <div class="mb-3">
                <label class="form-label small">Tanggal Akhir</label>

                <input type="date"
                       name="tgl_akhir"
                       id="tgl_akhir_rpt2"
                       class="form-control form-control-sm"
                       value="{{ now()->toDateString() }}"
                       required
                       onchange="cekTanggalRPT2()">
            </div>

            <div class="d-flex gap-2">

    <button type="submit"
            class="btn btn-primary flex-fill">
        Cetak PDF
    </button>

    <button type="submit"
            class="btn btn-success flex-fill"
            formaction="{{ route('laporan.pengembalian.excel') }}"
            formtarget="_blank">
        Cetak Excel
    </button>

</div>

        </form>
    </div>
</div>

<script>
function cekTanggalRPT2() {

    const awal = document.getElementById('tgl_awal_rpt2').value;
    const akhir = document.getElementById('tgl_akhir_rpt2').value;

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

            document.getElementById('tgl_awal_rpt2').value = hariIni;
            document.getElementById('tgl_akhir_rpt2').value = hariIni;

        });

        return false;
    }

    return true;
}
</script>
