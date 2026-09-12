<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Edit Data Pendaftaran - SIPENAL</title>

    <link rel="icon" type="image/png"
          href="{{ asset('gambar/logo-stock.png') }}">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f4f7fc;
        }

        .container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 30px;
        }

        .register-box {
            width: 1050px;
            min-height: 650px;
            display: flex;
            background: white;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.08);
        }

        /* BAGIAN KIRI */
        .left {
            width: 48%;
            background: linear-gradient(135deg, #1677ff, #0864df);
            color: white;
            padding: 70px 55px;
            position: relative;
            overflow: hidden;
        }

        .circle {
            position: absolute;
            width: 260px;
            height: 260px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            top: -120px;
            left: -80px;
        }

        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-top: 100px;
        }

        .logo-box {
            width: 45px;
            height: 45px;
            border: 2px solid white;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .logo h2 {
            margin: 0;
            font-size: 25px;
        }

        .logo small {
            display: block;
            margin-top: 3px;
        }

        .left h1 {
            font-size: 42px;
            line-height: 1.15;
            margin-top: 50px;
            margin-bottom: 25px;
        }

        .left p {
            font-size: 16px;
            line-height: 1.8;
            max-width: 400px;
        }

        /* BAGIAN KANAN */
        .right {
            width: 52%;
            padding: 45px 65px;
            overflow-y: auto;
        }

        .right h1 {
            margin: 0 0 8px;
            font-size: 32px;
            color: #111827;
        }

        .subtitle {
            color: #777;
            margin-bottom: 28px;
        }

        .form-group {
            margin-bottom: 18px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #111827;
        }

        input {
            width: 100%;
            padding: 14px;
            border: 1px solid #d5dce8;
            border-radius: 9px;
            font-size: 14px;
            outline: none;
        }

        input:focus {
            border-color: #2870ed;
        }

        .button-group {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }

        .btn {
            flex: 1;
            padding: 14px;
            border-radius: 9px;
            text-align: center;
            text-decoration: none;
            font-weight: bold;
            font-size: 14px;
            cursor: pointer;
        }

        .btn-back {
            border: 1px solid #cbd5e1;
            color: #374151;
            background: white;
        }

        .btn-save {
            border: none;
            color: white;
            background: #2864e8;
        }

        .btn-save:hover {
            background: #1d55cf;
        }

        .error {
            color: #dc2626;
            font-size: 13px;
            margin-top: 5px;
        }

        @media (max-width: 800px) {
            .register-box {
                width: 100%;
                flex-direction: column;
            }

            .left,
            .right {
                width: 100%;
            }

            .left {
                padding: 40px;
            }

            .logo {
                margin-top: 30px;
            }

            .left h1 {
                margin-top: 30px;
            }

            .right {
                padding: 35px;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="register-box">

        <!-- KIRI -->
        <div class="left">

            <div class="circle"></div>

            <div class="logo">
                <div class="logo-box">
                    ◇
                </div>

                <div>
                    <h2>SIPENAL</h2>
                    <small>Sistem Peminjaman Barang</small>
                </div>
            </div>

            <h1>
                Edit Data<br>
                Pendaftaran
            </h1>

            <p>
                Periksa kembali data akun kamu sebelum
                divalidasi oleh admin atau petugas.
            </p>

        </div>


        <!-- KANAN -->
        <div class="right">

            <h1>Edit Data</h1>

            <div class="subtitle">
                Periksa dan ubah data akun kamu sebelum divalidasi.
            </div>

            <form action="{{ route('register.update', $user->id) }}"
                  method="POST">

                @csrf
                @method('PUT')

                <!-- NAMA -->
                <div class="form-group">
                    <label>Nama Lengkap</label>

                    <input
                        type="text"
                        name="nama"
                        value="{{ old('nama', $user->nama) }}"
                        placeholder="Masukkan nama lengkap"
                        required
                    >

                    @error('nama')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>


                <!-- USERNAME -->
                <div class="form-group">
                    <label>Username</label>

                    <input
                        type="text"
                        name="username"
                        value="{{ old('username', $user->username) }}"
                        placeholder="Masukkan username"
                        required
                    >

                    @error('username')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>


                <!-- NO TELEPON -->
                <div class="form-group">
                    <label>No. Telepon</label>

                    <input
                        type="text"
                        name="no_telp"
                        value="{{ old('no_telp', $user->no_telp) }}"
                        placeholder="Masukkan nomor telepon"
                        required
                    >

                    @error('no_telp')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>


                <!-- EMAIL -->
                <div class="form-group">
                    <label>Email</label>

                    <input
                        type="email"
                        name="email"
                        value="{{ old('email', $user->email) }}"
                        placeholder="Masukkan email"
                        required
                    >

                    @error('email')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>


                <!-- PASSWORD -->
                <div class="form-group">
                    <label>Password Baru</label>

                    <input
                        type="password"
                        name="password"
                        placeholder="Kosongkan jika tidak ingin mengubah password"
                    >

                    @error('password')
                        <div class="error">{{ $message }}</div>
                    @enderror
                </div>


                <!-- KONFIRMASI PASSWORD -->
                <div class="form-group">
                    <label>Konfirmasi Password</label>

                    <input
                        type="password"
                        name="password_confirmation"
                        placeholder="Ulangi password baru"
                    >
                </div>


                <!-- BUTTON -->
                <div class="button-group">

                    <a href="{{ route('register.success', $user->id) }}"
                       class="btn btn-back">
                        ← Kembali
                    </a>

                    <button type="submit"
                            class="btn btn-save">
                        Simpan Perubahan
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>

</body>
</html>