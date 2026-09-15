<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alat;
use App\Models\Kategori;
use App\Models\Peminjaman;
use App\Models\Pengaturan;
use App\Models\Pengembalian;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Symfony\Component\HttpFoundation\StreamedResponse;

class LaporanController extends Controller
{
    public function form()
    {
        $daftarKategori = Kategori::orderBy('nama')->get();

        return view('laporan.form', compact('daftarKategori'));
    }

    public function peminjaman(Request $request)
    {
        $data = $request->validate([
            'tgl_awal' => ['required', 'date'],
            'tgl_akhir' => ['required', 'date', 'after_or_equal:tgl_awal'],
            'status' => ['nullable', 'string'],
        ]);

        $daftarPeminjaman = Peminjaman::with(['peminjam', 'detail.alat'])
            ->whereBetween('tgl_pinjam', [$data['tgl_awal'], $data['tgl_akhir']])
            ->when($data['status'] ?? null, function ($query, $status) {
                $query->where('status', $status);
            })
            ->orderBy('tgl_pinjam')
            ->get();

        $pdf = Pdf::loadView('laporan.peminjaman', [
            'daftarPeminjaman' => $daftarPeminjaman,
            'namaSekolah' => $this->namaSekolah(),
            'keteranganPeriode' => $this->keteranganPeriode($data),
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('laporan-peminjaman.pdf');
    }

    public function pengembalian(Request $request)
    {
        $data = $request->validate([
            'tgl_awal' => ['required', 'date'],
            'tgl_akhir' => ['required', 'date', 'after_or_equal:tgl_awal'],
        ]);

        $daftarPengembalian = Pengembalian::with([
            'peminjaman.peminjam',
            'peminjaman.detail.alat',
            'petugas',
        ])
            ->whereBetween('tgl_kembali', [$data['tgl_awal'], $data['tgl_akhir']])
            ->orderBy('tgl_kembali')
            ->get();

        $pdf = Pdf::loadView('laporan.pengembalian', [
            'daftarPengembalian' => $daftarPengembalian,
            'totalDenda' => $daftarPengembalian->sum('total_denda'),
            'namaSekolah' => $this->namaSekolah(),
            'keteranganPeriode' => $this->keteranganPeriode($data),
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('laporan-pengembalian.pdf');
    }

    public function stok(Request $request)
    {
        $data = $request->validate([
            'kategori_id' => ['nullable', 'exists:kategori,id'],
        ]);

        $daftarAlat = Alat::with('kategori')
            ->when($data['kategori_id'] ?? null, function ($query, $kategoriId) {
                $query->where('kategori_id', $kategoriId);
            })
            ->orderBy('kode_alat')
            ->get();

        $namaKategori = 'Semua Kategori';

        if (!empty($data['kategori_id'])) {
            $namaKategori = Kategori::find($data['kategori_id'])?->nama
                ?? 'Semua Kategori';
        }

        $pdf = Pdf::loadView('laporan.stok', [
            'daftarAlat' => $daftarAlat,
            'namaKategori' => $namaKategori,
            'namaSekolah' => $this->namaSekolah(),
            'keteranganPeriode' => null,
        ])->setPaper('a4', 'landscape');

        return $pdf->stream('laporan-stok.pdf');
    }

    private function namaSekolah(): string
    {
        return Pengaturan::ambil('nama_sekolah', 'Nama Sekolah');
    }

    private function keteranganPeriode(array $data): string
    {
        return date('d/m/Y', strtotime($data['tgl_awal']))
            . ' - '
            . date('d/m/Y', strtotime($data['tgl_akhir']));
    }

        // =========================================================
    // EXPORT EXCEL RPT-01 - PEMINJAMAN
    // =========================================================
    public function peminjamanExcel(Request $request)
    {
        $data = $request->validate([
            'tgl_awal' => ['required', 'date'],
            'tgl_akhir' => ['required', 'date', 'after_or_equal:tgl_awal'],
            'status' => ['nullable', 'string'],
        ]);

        $daftarPeminjaman = Peminjaman::with([
            'peminjam',
            'detail.alat'
        ])
            ->whereBetween('tgl_pinjam', [
                $data['tgl_awal'],
                $data['tgl_akhir']
            ])
            ->when($data['status'] ?? null, function ($query, $status) {
                $query->where('status', $status);
            })
            ->orderBy('tgl_pinjam')
            ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setTitle('Peminjaman');

        // Judul
        $sheet->setCellValue('A1', 'LAPORAN PEMINJAMAN');
        $sheet->setCellValue('A2', $this->namaSekolah());
        $sheet->setCellValue(
            'A3',
            'Periode: ' . $this->keteranganPeriode($data)
        );

        // Header
        $sheet->setCellValue('A5', 'No');
        $sheet->setCellValue('B5', 'Kode Pinjam');
        $sheet->setCellValue('C5', 'Nama Peminjam');
        $sheet->setCellValue('D5', 'Tanggal Pinjam');
        $sheet->setCellValue('E5', 'Alat');
        $sheet->setCellValue('F5', 'Jumlah');
        $sheet->setCellValue('G5', 'Status');

        $baris = 6;
        $no = 1;

        foreach ($daftarPeminjaman as $peminjaman) {

            $namaAlat = $peminjaman->detail
                ->map(function ($detail) {
                    return $detail->alat?->nama ?? '-';
                })
                ->implode(', ');

            $jumlah = $peminjaman->detail->sum('jumlah');

            $namaPeminjam = $peminjaman->peminjam?->name
                ?? $peminjaman->peminjam?->nama
                ?? '-';

            $sheet->setCellValue('A' . $baris, $no);
            $sheet->setCellValue(
                'B' . $baris,
                $peminjaman->kode_pinjam
            );
            $sheet->setCellValue(
                'C' . $baris,
                $namaPeminjam
            );
            $sheet->setCellValue(
                'D' . $baris,
                $peminjaman->tgl_pinjam
            );
            $sheet->setCellValue(
                'E' . $baris,
                $namaAlat
            );
            $sheet->setCellValue(
                'F' . $baris,
                $jumlah
            );
            $sheet->setCellValue(
    'G' . $baris,
    $peminjaman->status instanceof \BackedEnum
        ? $peminjaman->status->value
        : $peminjaman->status
);

            $baris++;
            $no++;
        }

        // Lebar otomatis
        // ================================
// STYLING TABEL
// ================================

// Header tabel
$sheet->getStyle('A5:G5')->getFont()->setBold(true);

// Border seluruh tabel
$sheet->getStyle('A5:G' . ($baris - 1))
    ->getBorders()
    ->getAllBorders()
    ->setBorderStyle(
        \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
    );

// Rata tengah untuk kolom tertentu
$sheet->getStyle('A5:A' . ($baris - 1))
    ->getAlignment()
    ->setHorizontal(
        \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
    );

$sheet->getStyle('D5:D' . ($baris - 1))
    ->getAlignment()
    ->setHorizontal(
        \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
    );

$sheet->getStyle('F5:F' . ($baris - 1))
    ->getAlignment()
    ->setHorizontal(
        \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
    );

$sheet->getStyle('G5:G' . ($baris - 1))
    ->getAlignment()
    ->setHorizontal(
        \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER
    );

// Lebar kolom
$sheet->getColumnDimension('A')->setWidth(6);
$sheet->getColumnDimension('B')->setWidth(23);
$sheet->getColumnDimension('C')->setWidth(22);
$sheet->getColumnDimension('D')->setWidth(18);
$sheet->getColumnDimension('E')->setWidth(40);
$sheet->getColumnDimension('F')->setWidth(10);
$sheet->getColumnDimension('G')->setWidth(18);

// Bekukan header
$sheet->freezePane('A6');

// Aktifkan filter
$sheet->setAutoFilter('A5:G' . ($baris - 1));

        $writer = new Xlsx($spreadsheet);

        return new StreamedResponse(
            function () use ($writer) {
                $writer->save('php://output');
            },
            200,
            [
                'Content-Type' =>
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',

                'Content-Disposition' =>
                    'attachment; filename="laporan-peminjaman.xlsx"',

                'Cache-Control' => 'max-age=0',
            ]
        );
    }


    // =========================================================
    // EXPORT EXCEL RPT-02 - PENGEMBALIAN & DENDA
    // =========================================================
    public function pengembalianExcel(Request $request)
    {
        $data = $request->validate([
            'tgl_awal' => ['required', 'date'],
            'tgl_akhir' => ['required', 'date', 'after_or_equal:tgl_awal'],
        ]);

        $daftarPengembalian = Pengembalian::with([
            'peminjaman.peminjam',
            'peminjaman.detail.alat',
            'petugas',
        ])
            ->whereBetween('tgl_kembali', [
                $data['tgl_awal'],
                $data['tgl_akhir']
            ])
            ->orderBy('tgl_kembali')
            ->get();

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setTitle('Pengembalian');

        // Judul
        $sheet->setCellValue(
            'A1',
            'LAPORAN PENGEMBALIAN & DENDA'
        );

        $sheet->setCellValue(
            'A2',
            $this->namaSekolah()
        );

        $sheet->setCellValue(
            'A3',
            'Periode: ' . $this->keteranganPeriode($data)
        );

        // Header
        $sheet->setCellValue('A5', 'No');
        $sheet->setCellValue('B5', 'Kode Pinjam');
        $sheet->setCellValue('C5', 'Nama Peminjam');
        $sheet->setCellValue('D5', 'Tanggal Kembali');
        $sheet->setCellValue('E5', 'Petugas');
        $sheet->setCellValue('F5', 'Total Denda');
        $sheet->setCellValue('G5', 'Status Pembayaran');

        $baris = 6;
        $no = 1;

        foreach ($daftarPengembalian as $pengembalian) {

            $namaPeminjam =
                $pengembalian->peminjaman?->peminjam?->name
                ?? $pengembalian->peminjaman?->peminjam?->nama
                ?? '-';

            $namaPetugas =
                $pengembalian->petugas?->nama
                ?? $pengembalian->petugas?->name
                ?? '-';

            $sheet->setCellValue(
                'A' . $baris,
                $no
            );

            $sheet->setCellValue(
                'B' . $baris,
                $pengembalian->peminjaman?->kode_pinjam ?? '-'
            );

            $sheet->setCellValue(
                'C' . $baris,
                $namaPeminjam
            );

            $sheet->setCellValue(
                'D' . $baris,
                $pengembalian->tgl_kembali
            );

            $sheet->setCellValue(
                'E' . $baris,
                $namaPetugas
            );

            $sheet->setCellValue(
                'F' . $baris,
                $pengembalian->total_denda ?? 0
            );

            $sheet->setCellValue(
                'G' . $baris,
                $pengembalian->status_pembayaran ?? '-'
            );

            $baris++;
            $no++;
        }

        // Total denda
        $sheet->setCellValue(
            'E' . $baris,
            'TOTAL DENDA'
        );

        $sheet->setCellValue(
            'F' . $baris,
            $daftarPengembalian->sum('total_denda')
        );

        $sheet->getStyle('E' . $baris . ':F' . $baris)
            ->getFont()
            ->setBold(true);

        foreach (range('A', 'G') as $kolom) {
            $sheet->getColumnDimension($kolom)->setAutoSize(true);
        }

        $sheet->getStyle('A5:G5')
            ->getFont()
            ->setBold(true);

        $writer = new Xlsx($spreadsheet);

        return new StreamedResponse(
            function () use ($writer) {
                $writer->save('php://output');
            },
            200,
            [
                'Content-Type' =>
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',

                'Content-Disposition' =>
                    'attachment; filename="laporan-pengembalian.xlsx"',

                'Cache-Control' => 'max-age=0',
            ]
        );
    }


    // =========================================================
    // EXPORT EXCEL RPT-03 - STOK ALAT
    // =========================================================
    public function stokExcel(Request $request)
    {
        $data = $request->validate([
            'kategori_id' => ['nullable', 'exists:kategori,id'],
        ]);

        $daftarAlat = Alat::with('kategori')
            ->when($data['kategori_id'] ?? null, function ($query, $kategoriId) {
                $query->where('kategori_id', $kategoriId);
            })
            ->orderBy('kode_alat')
            ->get();

        $namaKategori = 'Semua Kategori';

        if (!empty($data['kategori_id'])) {
            $namaKategori = Kategori::find($data['kategori_id'])?->nama
                ?? 'Semua Kategori';
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $sheet->setTitle('Stok Alat');

        // Judul
        $sheet->setCellValue(
            'A1',
            'REKAPITULASI STOK ALAT'
        );

        $sheet->setCellValue(
            'A2',
            $this->namaSekolah()
        );

        $sheet->setCellValue(
            'A3',
            'Kategori: ' . $namaKategori
        );

        // Header
        $sheet->setCellValue('A5', 'No');
        $sheet->setCellValue('B5', 'Kode Alat');
        $sheet->setCellValue('C5', 'Nama Alat');
        $sheet->setCellValue('D5', 'Kategori');
        $sheet->setCellValue('E5', 'Jumlah');
        $sheet->setCellValue('F5', 'Tersedia');

        $baris = 6;
        $no = 1;

        foreach ($daftarAlat as $alat) {

    $sheet->setCellValue(
        'A' . $baris,
        $no
    );

    $sheet->setCellValue(
        'B' . $baris,
        $alat->kode_alat
    );

    $sheet->setCellValue(
        'C' . $baris,
        $alat->nama
    );

    $sheet->setCellValue(
        'D' . $baris,
        $alat->kategori?->nama ?? '-'
    );

    $sheet->setCellValue(
        'E' . $baris,
        $alat->stok
    );

    $sheet->setCellValue(
        'F' . $baris,
        $alat->stok_tersedia
    );

    $baris++;
    $no++;
}

        foreach (range('A', 'F') as $kolom) {
            $sheet->getColumnDimension($kolom)->setAutoSize(true);
        }

        $sheet->getStyle('A5:F5')
            ->getFont()
            ->setBold(true);

        $writer = new Xlsx($spreadsheet);

        return new StreamedResponse(
            function () use ($writer) {
                $writer->save('php://output');
            },
            200,
            [
                'Content-Type' =>
                    'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',

                'Content-Disposition' =>
                    'attachment; filename="laporan-stok.xlsx"',

                'Cache-Control' => 'max-age=0',
            ]
        );
    }
}
