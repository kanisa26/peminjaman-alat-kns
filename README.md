# SIPENAL - Sistem Peminjaman Alat

Sistem Peminjaman Alat

Project UKK 2026

Dibuat oleh: Kanisa Afifatu Zahra  
Kelas: XII PPLG C

---

## Deskripsi Proyek

SIPENAL adalah aplikasi web berbasis Laravel untuk membantu proses peminjaman alat di lingkungan sekolah atau lembaga. Aplikasi ini dirancang untuk mempermudah pengelolaan data alat, proses pengajuan peminjaman, persetujuan peminjaman, verifikasi pengembalian, serta monitoring status peminjaman secara lebih terstruktur dan efisien.

Aplikasi ini dibuat sebagai proyek UKK (Ujian Kompetensi Keahlian) tahun 2026 dengan fokus pada kebutuhan sistem informasi manajemen inventaris dan peminjaman alat.

---

## Fitur Utama

- Manajemen data kategori alat
- Manajemen data alat dan stok
- Pengelolaan data pengguna dan validasi akun
- Katalog alat untuk peminjam
- Keranjang peminjaman
- Pengajuan peminjaman alat
- Persetujuan peminjaman oleh petugas/admin
- Verifikasi pengembalian alat
- Perhitungan denda keterlambatan
- Laporan data alat, peminjaman, dan pengembalian
- Dashboard berdasarkan peran pengguna
- Role-based access control menggunakan Laravel Permission

---

## Peran Pengguna

### 1. Admin
- Mengelola data alat, kategori, dan pengguna
- Mengatur sistem dan jadwal peminjaman
- Memantau keseluruhan aktivitas aplikasi

### 2. Petugas
- Meninjau pengajuan peminjaman
- Menyetujui atau menolak peminjaman
- Memverifikasi pengembalian alat

### 3. Peminjam
- Melihat katalog alat
- Mengajukan peminjaman
- Melihat riwayat peminjaman dan status pengembalian

---

## Teknologi yang Digunakan

- PHP 8.2
- Laravel Framework 12
- Laravel Fortify
- Spatie Laravel Permission
- Bootstrap 5
- MySQL / database Laravel standar
- DOMPDF untuk pembuatan laporan
- Vite untuk asset frontend

---

## Struktur Project

- app/ : Logika aplikasi, model, controller, policy, service
- config/ : Konfigurasi aplikasi Laravel
- database/ : Migrasi dan seeder
- public/ : File publik aplikasi
- resources/ : View, CSS, JS, frontend
- routes/ : Routing aplikasi
- storage/ : File runtime dan cache
- tests/ : Uji otomatis aplikasi

---

## Persyaratan Sistem

Sebelum menjalankan project, pastikan perangkat Anda telah menginstal:

- PHP 8.2+
- Composer
- Node.js dan npm
- Database MySQL / SQLite / database sesuai konfigurasi Laravel

---

## Cara Menjalankan Project

1. Clone repository ini
2. Masuk ke folder project
3. Install dependency PHP

   ```bash
   composer install
   ```

4. Salin file environment

   ```bash
   copy .env.example .env
   ```

   atau jika Linux/macOS:

   ```bash
   cp .env.example .env
   ```

5. Generate application key

   ```bash
   php artisan key:generate
   ```

6. Konfigurasi database di file `.env`

7. Jalankan migrasi database

   ```bash
   php artisan migrate
   ```

8. Install dependency frontend

   ```bash
   npm install
   ```

9. Build asset frontend

   ```bash
   npm run build
   ```

10. Jalankan aplikasi

   ```bash
   php artisan serve
   ```

   atau untuk mode development:

   ```bash
   npm run dev
   ```

---

## Catatan

Project ini dibuat untuk kebutuhan UKK 2026 dan masih dapat dikembangkan lebih lanjut sesuai kebutuhan sekolah atau organisasi yang menggunakan aplikasi ini.

---

## Pembuat

Kanisa Afifatu Zahra  
XII PPLG C  
UKK 2026

---

## Lisensi

Proyek ini dibuat untuk kepentingan pembelajaran dan pengembangan aplikasi serta dapat dikembangkan lebih lanjut sesuai kebutuhan.
