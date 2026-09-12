<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS trg_pengembalian_after_insert');

        DB::unprepared("
            CREATE TRIGGER trg_pengembalian_after_insert
            AFTER INSERT ON pengembalian
            FOR EACH ROW
            BEGIN
                DECLARE v_kode VARCHAR(20);

                UPDATE alat a
                JOIN detail_peminjaman d
                    ON d.alat_id = a.id
                SET a.stok_tersedia = LEAST(
                    a.stok,
                    a.stok_tersedia + d.jumlah
                )
                WHERE d.peminjaman_id = NEW.peminjaman_id
                AND d.kondisi_kembali IN ('baik', 'rusak_ringan');

                UPDATE alat a
                JOIN detail_peminjaman d
                    ON d.alat_id = a.id
                SET
                    a.stok_tersedia = LEAST(
                        a.stok_tersedia,
                        a.stok - d.jumlah
                    ),
                    a.stok = a.stok - d.jumlah
                WHERE d.peminjaman_id = NEW.peminjaman_id
                AND d.kondisi_kembali IN ('rusak_berat', 'hilang');

                UPDATE peminjaman
                SET
                    status = 'selesai',
                    updated_at = NOW()
                WHERE id = NEW.peminjaman_id;

                SELECT kode_pinjam
                INTO v_kode
                FROM peminjaman
                WHERE id = NEW.peminjaman_id;

                INSERT INTO log_aktivitas
                (
                    user_id,
                    aksi,
                    tabel_tujuan,
                    deskripsi,
                    created_at
                )
                VALUES
                (
                    NEW.petugas_id,
                    'verifikasi_kembali',
                    'pengembalian',
                    CONCAT(
                        'Memverifikasi pengembalian ',
                        v_kode,
                        ' dengan total denda ',
                        NEW.total_denda
                    ),
                    NOW()
                );
            END
        ");
    }

    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS trg_pengembalian_after_insert');
    }
};