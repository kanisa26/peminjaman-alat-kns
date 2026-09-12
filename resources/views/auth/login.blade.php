<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login - Stock Management</title>

    <link rel="icon" type="image/png"
          href="{{ asset('gambar/logo-stock.png') }}">

    <style>

        * {
            box-sizing: border-box;
        }

        html,
body {
    width: 100%;
    height: 100%;
    margin: 0;
    overflow: hidden;
}

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f8fafc;
        }

        /* ================================
   NAVBAR LOGIN
================================ */

.navbar-login {
    width: 100%;
    height: 65px;

    background: #ffffff;

    display: flex;
    align-items: center;
    justify-content: space-between;

    padding: 0 6%;

    border-bottom: 1px solid #e2e8f0;

    position: relative;
    z-index: 10;
}


/* BRAND */

.navbar-brand {
    display: flex;
    align-items: center;
    gap: 10px;

    text-decoration: none;
}

.navbar-brand img {
    width: 38px;
    height: 38px;

    object-fit: contain;
}

.navbar-brand-text {
    display: flex;
    flex-direction: column;
}

.navbar-brand-title {
    color: #2563eb;

    font-size: 16px;
    font-weight: 700;
}

.navbar-brand-subtitle {
    color: #64748b;

    font-size: 11px;
}


/* TOMBOL KEMBALI */

.btn-home {
    display: inline-flex;
    align-items: center;
    gap: 7px;

    padding: 9px 16px;

    border: 1px solid #dbeafe;
    border-radius: 8px;

    background: #eff6ff;

    color: #2563eb;

    text-decoration: none;

    font-size: 13px;
    font-weight: 600;

    transition: 0.2s;
}

.btn-home:hover {
    background: #2563eb;
    color: white;

    border-color: #2563eb;

    transform: translateY(-1px);
}


/* ================================
   CONTAINER
================================ */

.login-container {
    width: 100%;

    min-height: calc(100vh - 65px);

    display: flex;
}


        /* ================================
           BAGIAN KIRI
        ================================= */

        .login-kiri {
    width: 52%;
    height: calc(100vh - 65px);

            background: linear-gradient(
                135deg,
                #1d4ed8,
                #2563eb
            );

            color: white;

            padding: 55px 7%;

            display: flex;
            flex-direction: column;
            justify-content: space-between;

            position: relative;
            overflow: hidden;
        }


        /* Ornamen background */

        .login-kiri::before {
            content: "";
            position: absolute;

            width: 400px;
            height: 400px;

            border-radius: 50%;

            background: rgba(255,255,255,0.06);

            right: -180px;
            top: -150px;
        }

        .login-kiri::after {
            content: "";
            position: absolute;

            width: 300px;
            height: 300px;

            border-radius: 50%;

            background: rgba(255,255,255,0.05);

            right: -100px;
            bottom: -100px;
        }


        /* ================================
           KONTEN KIRI
        ================================= */

        .kiri-content {
            max-width: 560px;
            position: relative;
            z-index: 2;
        }


        /* ================================
           LOGO
        ================================= */

        .logo {
            width: 75px;
            height: 75px;

            margin-bottom: 25px;
        }

        .logo img {
            width: 70px;
            height: 70px;

            object-fit: contain;
        }


        /* ================================
           JUDUL
        ================================= */

        .kiri-content h1 {
            margin: 0;

            font-size: 38px;
            font-weight: 700;

            letter-spacing: 0.5px;
        }

        .instansi {
            margin-top: 12px;

            font-size: 16px;
            font-weight: 600;

            color: #dbeafe;
        }


        .subjudul {
            margin-top: 35px;

            font-size: 29px;
            font-weight: 700;

            line-height: 1.25;
        }


        .deskripsi {
            margin-top: 15px;

            max-width: 500px;

            font-size: 16px;

            line-height: 1.7;

            color: #dbeafe;
        }


        /* ================================
           FITUR
        ================================= */

        .fitur-list {
            display: flex;

            gap: 12px;

            margin-top: 35px;

            flex-wrap: wrap;
        }

        .fitur {
            min-width: 145px;

            padding: 14px 16px;

            background: rgba(255,255,255,0.12);

            border: 1px solid rgba(255,255,255,0.15);

            border-radius: 12px;

            backdrop-filter: blur(5px);

            transition: 0.2s;
        }

        .fitur:hover {
            transform: translateY(-3px);

            background: rgba(255,255,255,0.18);
        }

        .fitur-icon {
            font-size: 22px;

            margin-bottom: 7px;
        }

        .fitur-title {
            font-size: 13px;

            font-weight: 600;
        }

        .fitur-text {
            margin-top: 3px;

            font-size: 11px;

            color: #dbeafe;
        }


        /* ================================
           COPYRIGHT
        ================================= */

        .copyright {
            position: relative;
            z-index: 2;

            font-size: 13px;

            color: #dbeafe;
        }


        /* ================================
           BAGIAN KANAN
        ================================= */

        .login-kanan {
    width: 48%;
    height: calc(100vh - 65px);

            background: #ffffff;

            display: flex;
            align-items: center;
            justify-content: center;

            padding: 40px;
        }


        /* ================================
           LOGIN BOX
        ================================= */

        .login-box {
            width: 100%;
            max-width: 430px;
        }


        /* ================================
           JUDUL LOGIN
        ================================= */

        .login-box h2 {
            margin: 0;

            color: #0f172a;

            font-size: 32px;

            font-weight: 700;
        }

        .login-subjudul {
            margin-top: 9px;
            margin-bottom: 30px;

            color: #64748b;

            font-size: 15px;
        }


        /* ================================
           ALERT
        ================================= */

        .alert {
    padding: 14px 16px;
    margin-bottom: 20px;

    border-radius: 10px;

    background: #fee2e2;
    color: #991b1b;

    border: 1px solid #fecaca;

    font-size: 14px;
}


        /* ================================
           FORM
        ================================= */

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;

            margin-bottom: 8px;

            color: #334155;

            font-size: 14px;

            font-weight: 600;
        }


        /* ================================
           INPUT
        ================================= */

        .input-wrapper {
            position: relative;
        }

        .form-control {
            width: 100%;
            height: 50px;

            padding: 0 45px;

            border: 1px solid #cbd5e1;

            border-radius: 10px;

            background: #f8fafc;

            color: #0f172a;

            font-size: 14px;

            outline: none;

            transition: 0.2s;
        }

        .form-control:focus {
            border-color: #2563eb;

            background: white;

            box-shadow:
                0 0 0 3px rgba(37,99,235,0.10);
        }


        /* ================================
           ICON INPUT
        ================================= */

        .input-icon {
            position: absolute;

            left: 15px;
            top: 50%;

            transform: translateY(-50%);

            color: #64748b;

            pointer-events: none;
        }

        .input-icon svg {
            width: 19px;
            height: 19px;

            fill: #64748b;
        }


        /* ================================
   EYE BUTTON
================================ */

.eye-button {
    position: absolute;
    right: 12px;
    top: 50%;

    transform: translateY(-50%);

    width: 35px;
    height: 35px;

    border: none;
    background: transparent;

    display: flex;
    align-items: center;
    justify-content: center;

    cursor: pointer;

    padding: 0;
}

.eye-button svg {
    width: 19px;
    height: 19px;

    fill: none;
    stroke: #64748b;
    stroke-width: 2;
    stroke-linecap: round;
    stroke-linejoin: round;

    transition: 0.2s;
}

.eye-button:hover svg {
    stroke: #2563eb;
}


        /* ================================
           BUTTON LOGIN
        ================================= */

        .btn-login {
            width: 100%;
            height: 50px;

            margin-top: 5px;

            border: none;

            border-radius: 10px;

            background: #2563eb;

            color: white;

            font-size: 15px;

            font-weight: 600;

            cursor: pointer;

            transition: 0.2s;
        }

        .btn-login:hover {
            background: #1d4ed8;

            transform: translateY(-1px);

            box-shadow:
                0 6px 15px rgba(37,99,235,0.20);
        }

        .btn-login:active {
            transform: translateY(0);
        }


        /* ================================
   BANTUAN LOGIN
================================ */

.lupa-password {
    text-align: left;

    margin-top: 10px;
    margin-bottom: 25px;

    color: #64748b;

    font-size: 13px;
}

.btn-admin {
    border: none;
    background: none;

    padding: 0;

    color: #2563eb;

    font-size: 13px;
    font-weight: 500;

    cursor: pointer;

    transition: 0.2s;
}

.btn-admin:hover {
    color: #1d4ed8;
    text-decoration: underline;
}


/* ================================
   SIGN UP
================================ */

.sign-up {
    text-align: center;

    margin-top: 18px;
    padding-top: 18px;

    border-top: 1px solid #e2e8f0;

    color: #64748b;

    font-size: 13px;
}

.btn-sign-up {
    display: inline-block;

    margin-left: 4px;

    color: #2563eb;

    font-size: 13px;
    font-weight: 700;

    text-decoration: none;

    transition: 0.2s;
}

.btn-sign-up:hover {
    color: #1d4ed8;

    text-decoration: underline;
}


        /* ================================
           FOOTER LOGIN
        ================================= */

        .login-footer {
            text-align: center;

            margin-top: 35px;

            font-size: 12px;

            color: #94a3b8;
        }


        /* ================================
           RESPONSIVE
        ================================= */

        @media (max-width: 900px) {

            .login-kiri {
                width: 45%;
            }

            .login-kanan {
                width: 55%;
            }

            .kiri-content h1 {
                font-size: 30px;
            }

            .subjudul {
                font-size: 24px;
            }

            .fitur-list {
                flex-direction: column;
            }

        }


        @media (max-width: 768px) {

            .login-container {
                flex-direction: column;
            }

            .login-kiri,
            .login-kanan {
                width: 100%;
            }

            .login-kiri {
                min-height: auto;

                padding: 40px 25px;
            }

            .login-kanan {
                min-height: auto;

                padding: 45px 25px;
            }

            .subjudul {
                margin-top: 25px;
            }

            .fitur-list {
                flex-direction: row;
            }

            .fitur {
                flex: 1;
            }

        }

        /* ================================
   TOMBOL HUBUNGI ADMIN
================================ */

.btn-admin {
    border: none;
    background: none;
    padding: 0;

    color: #2563eb;

    font-size: 13px;
    font-weight: 500;

    cursor: pointer;
}

.btn-admin:hover {
    color: #1d4ed8;
    text-decoration: underline;
}


/* ================================
   MODAL ADMINISTRATOR
================================ */

.admin-modal {
    display: none;

    position: fixed;

    inset: 0;

    background: rgba(15, 23, 42, 0.45);

    backdrop-filter: blur(3px);

    align-items: center;
    justify-content: center;

    z-index: 9999;

    padding: 20px;
}


/* BOX */

.admin-modal-box {
    width: 100%;
    max-width: 400px;

    background: white;

    border-radius: 16px;

    padding: 30px;

    box-shadow:
        0 20px 50px rgba(15, 23, 42, 0.20);

    animation: modalMasuk 0.2s ease;
}


/* ANIMASI */

@keyframes modalMasuk {

    from {
        opacity: 0;
        transform: translateY(10px) scale(0.97);
    }

    to {
        opacity: 1;
        transform: translateY(0) scale(1);
    }

}


/* HEADER */

.admin-modal-header {
    display: flex;

    align-items: center;
    justify-content: space-between;

    margin-bottom: 20px;
}


.admin-modal-header h3 {
    margin: 0;

    color: #0f172a;

    font-size: 21px;
}


/* CLOSE */

.btn-close-admin {
    width: 32px;
    height: 32px;

    border: none;

    border-radius: 8px;

    background: #f1f5f9;

    color: #64748b;

    font-size: 20px;

    cursor: pointer;
}

.btn-close-admin:hover {
    background: #e2e8f0;

    color: #0f172a;
}


/* ICON */

.admin-icon {
    width: 55px;
    height: 55px;

    margin: 0 auto 15px;

    border-radius: 50%;

    background: #dbeafe;

    display: flex;

    align-items: center;
    justify-content: center;

    font-size: 27px;
}


/* TEXT */

.admin-modal-text {
    text-align: center;

    color: #64748b;

    font-size: 13px;

    line-height: 1.6;

    margin-bottom: 22px;
}


/* CONTACT */

.admin-contact {
    background: #f8fafc;

    border: 1px solid #e2e8f0;

    border-radius: 10px;

    padding: 14px 16px;

    margin-bottom: 10px;
}


.admin-contact-label {
    font-size: 11px;

    color: #64748b;

    margin-bottom: 4px;
}


.admin-contact-value {
    font-size: 14px;

    font-weight: 600;

    color: #0f172a;
}

/* ================================
   CONTACT BISA DIKLIK
================================ */

.admin-contact-link {
    display: block;

    text-decoration: none;

    cursor: pointer;

    transition: 0.2s;
}

.admin-contact-link:hover {
    background: #eff6ff;

    border-color: #93c5fd;

    transform: translateY(-2px);

    box-shadow: 0 4px 10px rgba(37, 99, 235, 0.08);
}

.admin-contact-link:hover .admin-contact-value {
    color: #2563eb;
}


/* TUTUP */

.btn-tutup-admin {
    width: 100%;

    height: 45px;

    margin-top: 12px;

    border: none;

    border-radius: 9px;

    background: #2563eb;

    color: white;

    font-size: 14px;

    font-weight: 600;

    cursor: pointer;
}

.btn-tutup-admin:hover {
    background: #1d4ed8;
}

.swal2-popup{
    border-radius:18px !important;
    padding:25px !important;
}

.swal-title{
    font-size:36px !important;
    font-weight:700 !important;
    color:#1e3a8a !important;
}

.swal2-icon.swal2-error{
    border-color:#ff6b6b !important;
    color:#ff6b6b !important;
}

.swal-button{
    border-radius:8px !important;
    padding:10px 35px !important;
    font-weight:600 !important;
    font-size:15px !important;
}

    </style>
</head>


<body>

{{-- =========================================
     NAVBAR
========================================== --}}

<nav class="navbar-login">

    {{-- BRAND --}}
    <a href="{{ route('home') }}" class="navbar-brand">

        <img
            src="{{ asset('gambar/ART.png') }}"
            alt="Logo"
        >

        <div class="navbar-brand-text">

            <div class="navbar-brand-title">
                SIPENAL
            </div>

            <div class="navbar-brand-subtitle">
                Sistem Peminjaman Alat
            </div>

        </div>

    </a>


    {{-- KEMBALI KE HOME --}}
    <a
        href="{{ route('home') }}"
        class="btn-home"
    >
        ← Kembali ke Home
    </a>

</nav>


<div class="login-container">


    {{-- =========================================
         BAGIAN KIRI
    ========================================== --}}

    <div class="login-kiri">

        <div class="kiri-content">

            {{-- LOGO --}}
            <div class="logo">

                <img
                    src="{{ asset('gambar/ART.png') }}"
                    alt="Logo Stock Management"
                >

            </div>


            {{-- BRAND --}}
            <h1>
                SIPENAL
            </h1>


            <div class="instansi">
                Sistem Peminjaman Alat
            </div>


            {{-- JUDUL UTAMA --}}
            <div class="subjudul">
                Peminjaman Alat
                Jadi Lebih Mudah.
            </div>


            {{-- DESKRIPSI --}}
            <div class="deskripsi">

                Kelola alat, lakukan peminjaman,
                dan pantau pengembalian dalam
                satu sistem yang praktis dan teratur.

            </div>


            {{-- FITUR --}}
            <div class="fitur-list">

                <div class="fitur">

                    <div class="fitur-icon">
                        📦
                    </div>

                    <div class="fitur-title">
                        Kelola Alat
                    </div>

                    <div class="fitur-text">
                        Data alat terorganisir
                    </div>

                </div>


                <div class="fitur">

                    <div class="fitur-icon">
                        📝
                    </div>

                    <div class="fitur-title">
                        Peminjaman
                    </div>

                    <div class="fitur-text">
                        Ajukan alat dengan mudah
                    </div>

                </div>


                <div class="fitur">

                    <div class="fitur-icon">
                        ↩️
                    </div>

                    <div class="fitur-title">
                        Pengembalian
                    </div>

                    <div class="fitur-text">
                        Pantau status alat
                    </div>

                </div>

            </div>

        </div>


        {{-- COPYRIGHT --}}
        <div class="copyright">

            © 2026 SMK Negeri 1 Padaherang

        </div>

    </div>



    {{-- =========================================
         BAGIAN KANAN
    ========================================== --}}

    <div class="login-kanan">

        <div class="login-box">


@if(session('gagal'))

<div class="alert">
    {{ session('gagal') }}
</div>

@endif


            {{-- JUDUL --}}
            <h2>
                Masuk ke Sistem
            </h2>

            <p class="login-subjudul">
                Silakan masuk menggunakan akun Anda
            </p>


            {{-- FORM --}}
            <form
                method="POST"
                action="{{ route('login.proses') }}"
            >

                @csrf


                {{-- USERNAME --}}
                <div class="form-group">

                    <label for="username">
                        Nama Pengguna
                    </label>

                    <div class="input-wrapper">

                        <span class="input-icon">

                            <svg viewBox="0 0 24 24">

                                <path d="
                                    M12 12
                                    a5 5 0 1 0 0-10
                                    a5 5 0 0 0 0 10

                                    M12 14
                                    c-5 0-8 2.5-8 6
                                    0 .6.4 1 1 1
                                    h14
                                    c.6 0 1-.4 1-1
                                    0-3.5-3-6-8-6
                                " />

                            </svg>

                        </span>


                        <input
                            type="text"
                            id="username"
                            name="username"
                            class="form-control"
                            value="{{ old('username') }}"
                            placeholder="Masukkan nama pengguna"
                            required
                            autofocus
                        >

                    </div>

                </div>


                {{-- PASSWORD --}}
                <div class="form-group">

                    <label for="password">
                        Kata Sandi
                    </label>

                    <div class="input-wrapper">

                        <span class="input-icon">

                            <svg viewBox="0 0 24 24">

                                <path d="
                                    M17 8h-1V6
                                    a4 4 0 0 0-8 0v2H7
                                    a2 2 0 0 0-2 2v9
                                    a2 2 0 0 0 2 2h10
                                    a2 2 0 0 0 2-2v-9
                                    a2 2 0 0 0-2-2

                                    M10 6
                                    a2 2 0 0 1 4 0v2h-4V6
                                " />

                            </svg>

                        </span>


                        <input
                            type="password"
                            id="password"
                            name="password"
                            class="form-control"
                            placeholder="Masukkan kata sandi"
                            required
                        >


                        <button
    type="button"
    class="eye-button"
    onclick="togglePassword()"
    aria-label="Tampilkan kata sandi"
>

    {{-- MATA DICORET --}}
    <svg
        id="eye-off-icon"
        viewBox="0 0 24 24"
    >
        <path d="
            M2 2
            L22 22
            M10.6 10.6
            a2 2 0 0 0 2.8 2.8

            M9.9 5.1
            C10.6 4.9 11.3 4.8 12 4.8
            C17 4.8 21 8.5 22 12
            C21.6 13.4 20.8 14.7 19.7 15.8

            M6.2 6.2
            C4.1 7.5 2.7 9.7 2 12
            C2.7 14.3 4.3 16.6 6.5 18
            C8.1 19 10 19.5 12 19.5
            C12.8 19.5 13.6 19.4 14.4 19.2
        " />
    </svg>


    {{-- MATA NORMAL --}}
    <svg
        id="eye-icon"
        viewBox="0 0 24 24"
        style="display: none;"
    >
        <path d="
            M12 5
            C7 5 3 8.5 2 12
            C3 15.5 7 19 12 19
            C17 19 21 15.5 22 12
            C21 8.5 17 5 12 5

            M12 16
            A4 4 0 1 0 12 8
            A4 4 0 0 0 12 16
        " />
    </svg>

</button>

                    </div>

                </div>

                 {{-- BANTUAN --}}
            <div class="lupa-password">

    Lupa kata sandi?

    <button
        type="button"
        class="btn-admin"
        onclick="openAdminModal()"
    >
        Hubungi Administrator.
    </button>

</div>


                {{-- LOGIN --}}
                <button
                    type="submit"
                    class="btn-login"
                >
                    Masuk
                </button>

            </form>


<div class="sign-up">

    Belum punya akun?

    <a
        href="{{ route('register') }}"
        class="btn-sign-up"
    >
        Sign Up
    </a>

</div>


            <div class="login-footer">

                Sistem Peminjaman dan Pengelolaan Alat

            </div>

        </div>

    </div>

</div>

{{-- =========================================
     MODAL ADMINISTRATOR
========================================== --}}

<div
    class="admin-modal"
    id="adminModal"
    onclick="closeAdminModal(event)"
>

    <div
        class="admin-modal-box"
        onclick="event.stopPropagation()"
    >

        {{-- HEADER --}}

        <div class="admin-modal-header">

            <h3>
                Hubungi Administrator
            </h3>

            <button
                type="button"
                class="btn-close-admin"
                onclick="closeAdminModal()"
            >
                ×
            </button>

        </div>


        {{-- ICON --}}

        <div class="admin-icon">
            👤
        </div>


        {{-- KETERANGAN --}}

        <div class="admin-modal-text">

            Jika Anda lupa kata sandi,
            akun belum divalidasi,
            atau mengalami kendala saat masuk
            ke sistem, silakan hubungi
            Administrator.

        </div>


        {{-- NAMA ADMIN --}}

        <div class="admin-contact">

            <div class="admin-contact-label">
                Administrator
            </div>

            <div class="admin-contact-value">
                Admin Stock Management
            </div>

        </div>


        {{-- EMAIL --}}

        <a
    href="mailto:kanisaafifatuz@gmail.com"
    class="admin-contact admin-contact-link"
>

    <div class="admin-contact-label">
        Email
    </div>

    <div class="admin-contact-value">
        admin@mail.com
    </div>

</a>


        {{-- WHATSAPP --}}

        <a
    href="https://wa.me/6285314943720"
    target="_blank"
    class="admin-contact admin-contact-link"
>

    <div class="admin-contact-label">
        WhatsApp
    </div>

    <div class="admin-contact-value">
        08xxxxxxxxxx
    </div>

</a>


        {{-- TOMBOL --}}

        <button
            type="button"
            class="btn-tutup-admin"
            onclick="closeAdminModal()"
        >
            Tutup
        </button>

    </div>

</div>

<script>

function togglePassword() {

    const password = document.getElementById('password');

    const eyeIcon = document.getElementById('eye-icon');

    const eyeOffIcon = document.getElementById('eye-off-icon');

    if (password.type === 'password') {

        // Tampilkan password
        password.type = 'text';

        // Tampilkan mata normal
        eyeIcon.style.display = 'block';

        // Sembunyikan mata dicoret
        eyeOffIcon.style.display = 'none';

    } else {

        // Sembunyikan password
        password.type = 'password';

        // Tampilkan mata dicoret
        eyeIcon.style.display = 'none';

        // Tampilkan mata dicoret
        eyeOffIcon.style.display = 'block';

    }

}

function openAdminModal() {

    document.getElementById('adminModal').style.display = 'flex';

}


function closeAdminModal() {

    document.getElementById('adminModal').style.display = 'none';

}


document.getElementById('adminModal').addEventListener(
    'click',
    function(event) {

        if (event.target === this) {

            closeAdminModal();

        }

    }
);


function closeAdminModal(event) {

    if (
        event &&
        event.target !== document.getElementById('adminModal')
    ) {
        return;
    }

    document.getElementById('adminModal').style.display = 'none';

}

</script>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@if($errors->has('login'))
<script>

    let pesan = @json($errors->first('login'));

    // ==========================================
    // AKUN DITOLAK
    // ==========================================

    if (pesan.startsWith('AKUN DITOLAK|')) {

        let alasan = pesan.split('|').slice(1).join('|');

        Swal.fire({

            icon: 'error',

            title: 'Akun Ditolak',

            html: `
                <hr style="
                    border:none;
                    border-top:1px solid #e5e7eb;
                    margin:15px 0;
                ">

                <div style="
                    color:#64748b;
                    font-size:15px;
                    margin-bottom:18px;
                ">
                    Akun Anda tidak disetujui oleh Administrator.
                </div>

                <div style="
                    background:#fff5f5;
                    border:1px solid #fecaca;
                    border-radius:10px;
                    padding:15px;
                    text-align:left;
                ">

                    <div style="
                        font-weight:700;
                        color:#991b1b;
                        margin-bottom:6px;
                    ">
                        Alasan Penolakan:
                    </div>

                    <div style="
                        color:#374151;
                        line-height:1.6;
                    ">
                        ${alasan}
                    </div>

                </div>
            `,

            confirmButtonText: 'OK',

            confirmButtonColor: '#2563eb',

            width: 500,

            customClass: {
                title: 'swal-title',
                confirmButton: 'swal-button'
            }

        });

    }

    // ==========================================
    // AKUN DINONAKTIFKAN
    // ==========================================

    else if (pesan.startsWith('AKUN NONAKTIF|')) {

        let pesanNonaktif = pesan.split('|').slice(1).join('|');

        Swal.fire({

            icon: 'warning',

            title: 'Akun Dinonaktifkan',

            html: `
                <div style="
                    color:#64748b;
                    font-size:15px;
                    line-height:1.6;
                    margin-top:10px;
                ">
                    ${pesanNonaktif}
                </div>
            `,

            confirmButtonText: 'OK',

            confirmButtonColor: '#2563eb',

            width: 450,

            customClass: {
                title: 'swal-title',
                confirmButton: 'swal-button'
            }

        });

    }

    // ==========================================
    // AKUN MENUNGGU VALIDASI
    // ==========================================

    else {

        Swal.fire({

            icon: 'warning',

            title: 'Akun Belum Aktif',

            text: pesan,

            confirmButtonText: 'OK',

            confirmButtonColor: '#2563eb',

            customClass: {
                title: 'swal-title',
                confirmButton: 'swal-button'
            }

        });

    }

</script>
@endif

</body>
</html>

</body>
</html>