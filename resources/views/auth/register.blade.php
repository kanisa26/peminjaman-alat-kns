<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sign Up - SIPENAL</title>

    <link rel="icon" type="image/png"
          href="{{ asset('gambar/logo-stock.png') }}">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: Arial, Helvetica, sans-serif;
            background: #f5f8ff;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 30px;
        }

        .register-wrapper {
            width: 100%;
            max-width: 1050px;
            min-height: 650px;
            background: white;
            border-radius: 22px;
            overflow: hidden;
            display: flex;
            box-shadow: 0 15px 45px rgba(0, 0, 0, 0.10);
        }

        /* BAGIAN KIRI */
        .register-left {
            width: 48%;
            background: linear-gradient(135deg, #0878ff, #075bd5);
            color: white;
            padding: 55px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
            overflow: hidden;
        }

        .register-left::before {
            content: "";
            position: absolute;
            width: 300px;
            height: 300px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.06);
            top: -100px;
            left: -100px;
        }

        .register-left::after {
            content: "";
            position: absolute;
            width: 250px;
            height: 250px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.05);
            bottom: -100px;
            right: -80px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 45px;
            position: relative;
            z-index: 2;
        }

        .logo-icon {
            width: 45px;
            height: 45px;
            border: 2px solid white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .logo-text h2 {
            font-size: 25px;
            margin-bottom: 3px;
        }

        .logo-text span {
            font-size: 11px;
            opacity: 0.85;
        }

        .register-left h1 {
            font-size: 42px;
            line-height: 1.15;
            margin-bottom: 20px;
            position: relative;
            z-index: 2;
        }

        .register-left p {
            font-size: 15px;
            line-height: 1.8;
            opacity: 0.9;
            max-width: 420px;
            position: relative;
            z-index: 2;
        }

        .box-icon {
            margin-top: 40px;
            width: 130px;
            height: 130px;
            border: 3px solid rgba(255, 255, 255, 0.85);
            border-radius: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 55px;
            position: relative;
            z-index: 2;
        }

        /* BAGIAN KANAN */
        .register-right {
            width: 52%;
            padding: 50px 65px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .register-title {
            margin-bottom: 28px;
        }

        .register-title h2 {
            color: #222;
            font-size: 30px;
            margin-bottom: 8px;
        }

        .register-title p {
            color: #777;
            font-size: 14px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }

        .form-control {
            width: 100%;
            height: 48px;
            border: 1px solid #dfe3eb;
            border-radius: 9px;
            padding: 0 15px;
            font-size: 14px;
            outline: none;
            transition: 0.2s;
        }

        .form-control:focus {
            border-color: #0878ff;
            box-shadow: 0 0 0 3px rgba(8, 120, 255, 0.10);
        }

        .password-wrapper {
            position: relative;
        }

        .password-wrapper .form-control {
            padding-right: 48px;
        }

        .toggle-password {
            position: absolute;
            right: 15px;
            top: 50%;
            transform: translateY(-50%);
            border: none;
            background: none;
            cursor: pointer;
            font-size: 18px;
            color: #777;
        }

        .info-box {
            background: #eef6ff;
            border-left: 4px solid #0878ff;
            padding: 12px 14px;
            border-radius: 7px;
            color: #555;
            font-size: 12px;
            line-height: 1.5;
            margin-bottom: 20px;
        }

        .btn-register {
            width: 100%;
            height: 48px;
            border: none;
            border-radius: 9px;
            background: #0878ff;
            color: white;
            font-size: 15px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }

        .btn-register:hover {
            background: #0669e5;
            transform: translateY(-1px);
        }

        .login-text {
            text-align: center;
            margin-top: 22px;
            color: #777;
            font-size: 14px;
        }

        .login-text a {
            color: #0878ff;
            font-weight: bold;
            text-decoration: none;
        }

        .login-text a:hover {
            text-decoration: underline;
        }

        .error {
            color: #dc3545;
            font-size: 12px;
            margin-top: 5px;
        }

        @media (max-width: 850px) {
            .register-wrapper {
                max-width: 550px;
            }

            .register-left {
                display: none;
            }

            .register-right {
                width: 100%;
                padding: 45px;
            }
        }

        @media (max-width: 500px) {
            body {
                padding: 15px;
            }

            .register-right {
                padding: 30px 25px;
            }
        }
    </style>
</head>

<body>

<div class="register-wrapper">

    <!-- KIRI -->
    <div class="register-left">

        <div class="logo">
            <div class="logo-icon">
                ◇
            </div>

            <div class="logo-text">
                <h2>SIPENAL</h2>
                <span>Sistem Peminjaman Barang</span>
            </div>
        </div>

        <h1>
            Buat Akun<br>
            Baru di SIPENAL
        </h1>

        <p>
            Daftarkan akun kamu untuk menggunakan sistem
            peminjaman alat secara mudah, cepat, dan teratur.
        </p>

        <div class="box-icon">
            □
        </div>

    </div>


    <!-- KANAN -->
    <div class="register-right">

        <div class="register-title">
            <h2>Sign Up</h2>
            <p>Lengkapi data berikut untuk membuat akun baru.</p>
        </div>

        @if ($errors->any())
            <div class="info-box" style="border-left-color:#dc3545; background:#fff2f2;">
                Terdapat kesalahan pada data yang kamu masukkan.
            </div>
        @endif

        <form action="{{ route('register.store') }}" method="POST">

            @csrf

            <div class="form-group">
                <label for="nama">Nama Lengkap</label>

                <input
                    type="text"
                    id="nama"
                    name="nama"
                    class="form-control"
                    placeholder="Masukkan nama lengkap"
                    value="{{ old('nama') }}"
                    required
                >

                @error('nama')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
    <label for="username">Username</label>

    <input
        type="text"
        id="username"
        name="username"
        class="form-control"
        placeholder="Masukkan username"
        value="{{ old('username') }}"
        required
    >

    @error('username')
        <div class="error">{{ $message }}</div>
    @enderror
</div>

<div class="form-group">
    <label for="no_telp">No. Telepon</label>

    <input
        type="text"
        id="no_telp"
        name="no_telp"
        class="form-control"
        placeholder="Masukkan nomor telepon"
        value="{{ old('no_telp') }}"
    >

    @error('no_telp')
        <div class="error">{{ $message }}</div>
    @enderror
</div>


            <div class="form-group">
                <label for="email">Email</label>

                <input
                    type="email"
                    id="email"
                    name="email"
                    class="form-control"
                    placeholder="Masukkan email"
                    value="{{ old('email') }}"
                    required
                >

                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-group">
                <label for="password">Password</label>

                <div class="password-wrapper">
                    <input
                        type="password"
                        id="password"
                        name="password"
                        class="form-control"
                        placeholder="Masukkan password"
                        required
                    >

                    <button
                        type="button"
                        class="toggle-password"
                        onclick="togglePassword('password', this)">
                        👁
                    </button>
                </div>

                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>


            <div class="form-group">
                <label for="password_confirmation">
                    Konfirmasi Password
                </label>

                <div class="password-wrapper">
                    <input
                        type="password"
                        id="password_confirmation"
                        name="password_confirmation"
                        class="form-control"
                        placeholder="Ulangi password"
                        required
                    >

                    <button
                        type="button"
                        class="toggle-password"
                        onclick="togglePassword('password_confirmation', this)">
                        👁
                    </button>
                </div>
            </div>


            <div class="info-box">
                <strong>Informasi:</strong><br>
                Setelah melakukan pendaftaran, akun kamu akan
                menunggu validasi dari admin sebelum dapat digunakan
                untuk login.
            </div>


            <button type="submit" class="btn-register">
                Daftar Sekarang
            </button>

        </form>


        <div class="login-text">
            Sudah punya akun?
            <a href="{{ route('login') }}">Login di sini</a>
        </div>

    </div>

</div>


<script>
    function togglePassword(id, button) {

        const input = document.getElementById(id);

        if (input.type === "password") {
            input.type = "text";
            button.textContent = "🙈";
        } else {
            input.type = "password";
            button.textContent = "👁";
        }
    }
</script>

</body>
</html>