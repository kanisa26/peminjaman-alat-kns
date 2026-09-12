<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SIPENAL - Sistem Peminjaman Alat</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        rel="stylesheet">

    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <style>

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: Arial, sans-serif;
            background: #f8fafc;
            color: #172b4d;
        }

        /* ================= NAVBAR ================= */

        .navbar-custom {
    background: #0d6efd;
    padding: 16px 6%;
    position: sticky;
    top: 0;
    z-index: 1000;
}

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            text-decoration: none;
            font-weight: 700;
            font-size: 23px;
        }

        .brand small {
            display: block;
            font-size: 10px;
            font-weight: 400;
            opacity: .9;
        }

        .nav-link-custom {
            color: white;
            text-decoration: none;
            margin: 0 12px;
            font-size: 14px;
        }

        .nav-link-custom:hover {
            color: #dbeafe;
        }

        .btn-login {
            background: white;
            color: #0d6efd;
            border-radius: 8px;
            padding: 9px 20px;
            text-decoration: none;
            font-weight: 600;
        }

        .btn-login:hover {
            background: #eef5ff;
            color: #0d6efd;
        }

        /* ================= HERO ================= */

        .hero {
            background: linear-gradient(135deg, #0d6efd, #0754c9);
            color: white;
            padding: 85px 6% 100px;
        }

        .hero-content {
            max-width: 1200px;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 50px;
        }

        .hero-text {
            max-width: 620px;
        }

        .hero-badge {
            display: inline-block;
            background: rgba(255,255,255,.15);
            padding: 8px 15px;
            border-radius: 30px;
            font-size: 13px;
            margin-bottom: 20px;
        }

        .hero h1 {
            font-size: 48px;
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 20px;
        }

        .hero p {
            font-size: 17px;
            line-height: 1.7;
            opacity: .9;
            margin-bottom: 30px;
        }

        .btn-hero {
            display: inline-block;
            background: white;
            color: #0d6efd;
            padding: 13px 25px;
            border-radius: 9px;
            text-decoration: none;
            font-weight: 600;
            margin-right: 10px;
        }

        .btn-outline-hero {
            display: inline-block;
            border: 1px solid rgba(255,255,255,.7);
            color: white;
            padding: 12px 25px;
            border-radius: 9px;
            text-decoration: none;
            font-weight: 600;
        }

        /* HERO ILUSTRASI */

        .hero-illustration {
            width: 390px;
            height: 320px;
            background: rgba(255,255,255,.12);
            border-radius: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-illustration i {
            font-size: 150px;
            color: white;
        }

        /* ================= STATISTIK ================= */

        .statistics {
            margin-top: -45px;
            position: relative;
            z-index: 2;
        }

        .stat-container {
            max-width: 1100px;
            margin: auto;
            background: white;
            border-radius: 15px;
            padding: 25px;
            box-shadow: 0 8px 30px rgba(0,0,0,.08);
        }

        .stat {
            text-align: center;
            border-right: 1px solid #e5e7eb;
        }

        .stat:last-child {
            border-right: none;
        }

        .stat i {
            font-size: 27px;
            color: #0d6efd;
        }

        .stat h3 {
            font-weight: 700;
            margin: 5px 0;
        }

        .stat p {
            color: #718096;
            margin: 0;
            font-size: 14px;
        }

        /* ================= SECTION ================= */

        .section {
            padding: 85px 6%;
        }

        .section-title {
            text-align: center;
            margin-bottom: 45px;
        }

        .section-title h2 {
            font-weight: 700;
            margin-bottom: 10px;
        }

        .section-title p {
            color: #718096;
        }

        /* ================= FITUR ================= */

        .feature-card {
            height: 100%;
            background: white;
            border: 1px solid #e8edf3;
            border-radius: 15px;
            padding: 28px;
            transition: .3s;
        }

        .feature-card:hover {
            transform: translateY(-7px);
            box-shadow: 0 12px 30px rgba(13,110,253,.12);
            border-color: #cfe2ff;
        }

        .feature-icon {
            width: 55px;
            height: 55px;
            background: #eaf3ff;
            color: #0d6efd;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 25px;
            margin-bottom: 20px;
        }

        .feature-card h5 {
            font-weight: 700;
            margin-bottom: 10px;
        }

        .feature-card p {
            color: #718096;
            font-size: 14px;
            line-height: 1.6;
            margin: 0;
        }

        /* ================= CARA KERJA ================= */

        .step {
            text-align: center;
            position: relative;
        }

        .step-number {
            width: 55px;
            height: 55px;
            background: #0d6efd;
            color: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 18px;
            font-size: 20px;
            font-weight: bold;
        }

        .step h5 {
            font-weight: 700;
        }

        .step p {
            color: #718096;
            font-size: 14px;
        }

        /* ================= CTA ================= */

        .cta {
            margin: 30px 6% 70px;
            background: linear-gradient(135deg, #0d6efd, #0754c9);
            color: white;
            border-radius: 20px;
            padding: 60px 30px;
            text-align: center;
        }

        .cta h2 {
            font-weight: 700;
            margin-bottom: 12px;
        }

        .cta p {
            opacity: .9;
            margin-bottom: 25px;
        }

        /* ================= FOOTER ================= */

        footer {
            background: #10233f;
            color: white;
            padding: 35px 6%;
        }

        .footer-content {
            max-width: 1200px;
            margin: auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        footer p {
            margin: 0;
            color: #cbd5e1;
            font-size: 13px;
        }

        @media(max-width: 768px) {

            .hero-content {
                flex-direction: column;
                text-align: center;
            }

            .hero h1 {
                font-size: 36px;
            }

            .hero-illustration {
                width: 100%;
            }

            .stat {
                border-right: none;
                border-bottom: 1px solid #eee;
                padding: 15px;
            }

            .footer-content {
                flex-direction: column;
                gap: 15px;
                text-align: center;
            }

        }

        .btn-signup {
    background: transparent;
    color: white;
    border: 1px solid white;
    border-radius: 8px;
    padding: 8px 20px;
    margin-left: 10px;
    text-decoration: none;
    font-weight: 600;
}

.btn-signup:hover {
    background: white;
    color: #0d6efd;
}

.brand {
    display: flex;
    align-items: center;
    gap: 10px;
    text-decoration: none;
    color: white;
}

.logo-sipenal {
    width: 38px;
    height: 38px;
    object-fit: contain;
}

.brand-text {
    display: flex;
    flex-direction: column;
}

.brand-text strong {
    font-size: 24px;
    line-height: 1;
}

.brand-text small {
    font-size: 10px;
    margin-top: 5px;
    opacity: 0.9;
}

    </style>
</head>

<body>

    {{-- ================= NAVBAR ================= --}}

    <nav class="navbar-custom">

        <div class="container-fluid d-flex align-items-center justify-content-between">

            <a href="{{ url('/') }}" class="brand">
    <img src="{{ asset('gambar/ART.png') }}" 
         alt="Logo SIPENAL"
         class="logo-sipenal">

    <div class="brand-text">
        <strong>SIPENAL</strong>
        <small>Sistem Peminjaman Barang</small>
    </div>
</a>

            <div class="d-flex align-items-center">

                <a href="#beranda" class="nav-link-custom">
                    Beranda
                </a>

                <a href="#fitur" class="nav-link-custom">
                    Fitur
                </a>

                <a href="#cara-kerja" class="nav-link-custom">
                    Cara Kerja
                </a>

                <a href="#tentang" class="nav-link-custom">
                    Tentang
                </a>

                <a href="#kontak" class="nav-link-custom">
    Kontak
</a>

                <a href="{{ route('login') }}" class="btn-login">
                    Login
                </a>

                <a href="{{ route('register') }}" class="btn-signup">
    Sign Up
</a>

            </div>

        </div>

    </nav>


    {{-- ================= HERO ================= --}}

    <section class="hero" id="beranda">

        <div class="hero-content">

            <div class="hero-text">

                <span class="hero-badge">
                    <i class="bi bi-stars"></i>
                    Sistem Informasi Peminjaman Alat
                </span>

                <h1>
                    Kelola Peminjaman Alat
                    Lebih Mudah & Teratur
                </h1>

                <p>
                    SIPENAL membantu sekolah dalam mengelola
                    data alat, peminjaman, pengembalian,
                    verifikasi, hingga laporan secara
                    terintegrasi dalam satu sistem.
                </p>

                <a href="{{ route('login') }}" class="btn-hero">
                    Mulai Sekarang
                    <i class="bi bi-arrow-right"></i>
                </a>

                <a href="#fitur" class="btn-outline-hero">
                    Lihat Fitur
                </a>

            </div>


            <div class="hero-illustration">

                <i class="bi bi-box-seam"></i>

            </div>

        </div>

    </section>


    {{-- ================= STATISTIK ================= --}}

    <section class="statistics">

        <div class="stat-container">

            <div class="row">

                <div class="col-md-3 stat">

                    <i class="bi bi-box-seam"></i>

                    <h3>{{ $totalAlat ?? 0 }}</h3>

                    <p>Total Alat</p>

                </div>

                <div class="col-md-3 stat">

                    <i class="bi bi-grid"></i>

                    <h3>{{ $totalKategori ?? 0 }}</h3>

                    <p>Kategori Alat</p>

                </div>

                <div class="col-md-3 stat">

                    <i class="bi bi-journal-check"></i>

                    <h3>{{ $totalPeminjaman ?? 0 }}</h3>

                    <p>Total Peminjaman</p>

                </div>

                <div class="col-md-3 stat">

                    <i class="bi bi-people"></i>

                    <h3>{{ $totalPengguna ?? 0 }}</h3>

                    <p>Pengguna</p>

                </div>

            </div>

        </div>

    </section>


    {{-- ================= FITUR ================= --}}

    <section class="section" id="fitur">

        <div class="section-title">

            <h2>Fitur SIPENAL</h2>

            <p>
                Semua kebutuhan pengelolaan peminjaman alat
                tersedia dalam satu sistem.
            </p>

        </div>


        <div class="container">

            <div class="row g-4">

                {{-- Katalog --}}

                <div class="col-md-6 col-lg-3">

                    <div class="feature-card">

                        <div class="feature-icon">
                            <i class="bi bi-grid-3x3-gap"></i>
                        </div>

                        <h5>Katalog Alat</h5>

                        <p>
                            Melihat daftar alat yang tersedia
                            lengkap dengan kategori, stok,
                            kondisi, dan jumlah tersedia.
                        </p>

                    </div>

                </div>


                {{-- Keranjang --}}

                <div class="col-md-6 col-lg-3">

                    <div class="feature-card">

                        <div class="feature-icon">
                            <i class="bi bi-cart3"></i>
                        </div>

                        <h5>Keranjang Peminjaman</h5>

                        <p>
                            Pilih beberapa alat sekaligus
                            sebelum mengajukan peminjaman.
                        </p>

                    </div>

                </div>


                {{-- Pengajuan --}}

                <div class="col-md-6 col-lg-3">

                    <div class="feature-card">

                        <div class="feature-icon">
                            <i class="bi bi-send"></i>
                        </div>

                        <h5>Pengajuan</h5>

                        <p>
                            Ajukan peminjaman alat secara
                            mudah melalui sistem.
                        </p>

                    </div>

                </div>


                {{-- Persetujuan --}}

                <div class="col-md-6 col-lg-3">

                    <div class="feature-card">

                        <div class="feature-icon">
                            <i class="bi bi-check2-circle"></i>
                        </div>

                        <h5>Persetujuan</h5>

                        <p>
                            Petugas dapat memeriksa dan
                            memproses pengajuan peminjaman.
                        </p>

                    </div>

                </div>


                {{-- Pemantauan --}}

                <div class="col-md-6 col-lg-3">

                    <div class="feature-card">

                        <div class="feature-icon">
                            <i class="bi bi-eye"></i>
                        </div>

                        <h5>Pemantauan</h5>

                        <p>
                            Memantau peminjaman yang sedang
                            berjalan dan tanggal pengembalian.
                        </p>

                    </div>

                </div>


                {{-- Pengembalian --}}

                <div class="col-md-6 col-lg-3">

                    <div class="feature-card">

                        <div class="feature-icon">
                            <i class="bi bi-arrow-return-left"></i>
                        </div>

                        <h5>Pengembalian</h5>

                        <p>
                            Mengelola proses pengembalian alat
                            yang telah selesai digunakan.
                        </p>

                    </div>

                </div>


                {{-- Verifikasi --}}

                <div class="col-md-6 col-lg-3">

                    <div class="feature-card">

                        <div class="feature-icon">
                            <i class="bi bi-shield-check"></i>
                        </div>

                        <h5>Verifikasi</h5>

                        <p>
                            Petugas dapat memverifikasi kondisi
                            alat dan menghitung denda.
                        </p>

                    </div>

                </div>


                {{-- Laporan --}}

                <div class="col-md-6 col-lg-3">

                    <div class="feature-card">

                        <div class="feature-icon">
                            <i class="bi bi-file-earmark-bar-graph"></i>
                        </div>

                        <h5>Laporan</h5>

                        <p>
                            Menghasilkan laporan peminjaman,
                            pengembalian, denda, dan stok alat.
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>


    {{-- ================= CARA KERJA ================= --}}

    <section class="section bg-white" id="cara-kerja">

        <div class="section-title">

            <h2>Cara Kerja SIPENAL</h2>

            <p>
                Proses peminjaman alat menjadi lebih sederhana.
            </p>

        </div>


        <div class="container">

            <div class="row g-4">

                <div class="col-md-3 step">

                    <div class="step-number">
                        1
                    </div>

                    <h5>Pilih Alat</h5>

                    <p>
                        Cari dan pilih alat yang ingin dipinjam
                        melalui katalog.
                    </p>

                </div>


                <div class="col-md-3 step">

                    <div class="step-number">
                        2
                    </div>

                    <h5>Ajukan</h5>

                    <p>
                        Masukkan alat ke keranjang dan
                        kirim pengajuan.
                    </p>

                </div>


                <div class="col-md-3 step">

                    <div class="step-number">
                        3
                    </div>

                    <h5>Diproses</h5>

                    <p>
                        Petugas memeriksa dan menyetujui
                        pengajuan.
                    </p>

                </div>


                <div class="col-md-3 step">

                    <div class="step-number">
                        4
                    </div>

                    <h5>Kembalikan</h5>

                    <p>
                        Setelah selesai digunakan, alat
                        dikembalikan untuk diverifikasi.
                    </p>

                </div>

            </div>

        </div>

    </section>


    {{-- ================= TENTANG ================= --}}

    <section class="section" id="tentang">

    <div class="container">

        <div class="row align-items-center g-5">

            {{-- BAGIAN KIRI --}}
            <div class="col-md-6">

                <h2 class="fw-bold mb-3">
                    Tentang SIPENAL
                </h2>

                <p class="text-muted">
                    SIPENAL merupakan sistem informasi yang digunakan
                    untuk membantu proses pengelolaan peminjaman alat
                    di lingkungan sekolah.
                </p>

                <p class="text-muted">
                    Sistem ini mengintegrasikan pengelolaan data alat,
                    pengguna, peminjaman, pengembalian, verifikasi,
                    hingga pembuatan laporan.
                </p>

            </div>


            {{-- BAGIAN KANAN --}}
            <div class="col-md-6">

                <a href="https://www.google.com/maps/search/?api=1&query=SMK+Negeri+1+Padaherang"
   target="_blank"
   style="text-decoration: none; color: inherit;">

    <div class="feature-card text-center p-5">

        <img src="{{ asset('gambar/gedung.png') }}"
             alt="Gedung Sekolah"
             style="width:80px; height:80px; object-fit:contain;">

        <h4 class="mt-3">
            SMK Negeri 1 Padaherang
        </h4>

        <p class="text-muted mb-0">
            Sistem Peminjaman Alat
        </p>

    </div>

</a>

            </div>

        </div>

    </div>

</section>

{{-- ================= KONTAK ================= --}}

<section class="section bg-white" id="kontak">

    <div class="section-title">

        <h2>Kontak Kami</h2>

        <p>
            Hubungi kami jika membutuhkan informasi mengenai SIPENAL.
        </p>

    </div>

    <div class="container">

        <div class="row g-4 justify-content-center">

            {{-- Instagram --}}
            <div class="col-md-4">

                <a href="https://www.instagram.com/" 
                   target="_blank"
                   style="text-decoration: none; color: inherit;">

                    <div class="feature-card text-center p-4">

                        <div class="feature-icon mx-auto">

                            <i class="bi bi-instagram"></i>

                        </div>

                        <h5>Instagram</h5>

                        <p>
                            Kunjungi Instagram sekolah
                        </p>

                    </div>

                </a>

            </div>


            {{-- Telepon --}}
            <div class="col-md-4">

                <a href="tel:08XXXXXXXXXX"
                   style="text-decoration: none; color: inherit;">

                    <div class="feature-card text-center p-4">

                        <div class="feature-icon mx-auto">

                            <i class="bi bi-telephone"></i>

                        </div>

                        <h5>Telepon</h5>

                        <p>
                            Hubungi pihak sekolah
                        </p>

                    </div>

                </a>

            </div>


            {{-- Email --}}
            <div class="col-md-4">

                <a href="mailto:emailsekolah@gmail.com"
                   style="text-decoration: none; color: inherit;">

                    <div class="feature-card text-center p-4">

                        <div class="feature-icon mx-auto">

                            <i class="bi bi-envelope"></i>

                        </div>

                        <h5>Email</h5>

                        <p>
                            Hubungi melalui email sekolah
                        </p>

                    </div>

                </a>

            </div>

        </div>

    </div>

</section>


    {{-- ================= FOOTER ================= --}}

    <footer>

        <div class="footer-content">

            <div>

                <strong>
                    <i class="bi bi-box-seam"></i>
                    SIPENAL
                </strong>

                <p>
                    Sistem Peminjaman Barang
                </p>

            </div>

            <p>
                © {{ date('Y') }} SIPENAL.
                SMK Negeri 1 Padaherang.
            </p>

        </div>

    </footer>

</body>

</html>