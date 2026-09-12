<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pendaftaran Berhasil - SIPENAL</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f5f7fb;
            margin: 0;
            padding: 40px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 35px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,.08);
        }

        h1 {
            color: #0d6efd;
        }

        .detail {
            margin-top: 25px;
        }

        .row {
            padding: 12px 0;
            border-bottom: 1px solid #eee;
        }

        .label {
            font-weight: bold;
            display: block;
            margin-bottom: 5px;
        }

        .status {
            display: inline-block;
            padding: 8px 15px;
            background: #fff3cd;
            color: #856404;
            border-radius: 20px;
            font-weight: bold;
        }

        .btn {
            display: block;
            text-align: center;
            margin-top: 25px;
            padding: 12px;
            background: #0d6efd;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>✓ Pendaftaran Berhasil</h1>

    <p>
        Akun kamu berhasil didaftarkan.
        Berikut adalah detail data yang kamu masukkan:
    </p>

    <div class="detail">

        <div class="row">
            <span class="label">Nama Lengkap</span>
            {{ $user->name }}
        </div>

        <div class="row">
            <span class="label">Username</span>
            {{ $user->username }}
        </div>

        <div class="row">
            <span class="label">No. Telepon</span>
            {{ $user->telepon }}
        </div>

        <div class="row">
            <span class="label">Email</span>
            {{ $user->email }}
        </div>

        <div class="row">
            <span class="label">Status Akun</span>

            <span class="status">
                Menunggu Validasi Admin
            </span>
        </div>

    </div>

    <p>
        Silakan tunggu Admin melakukan validasi akun.
        Setelah akun divalidasi, kamu dapat melakukan login ke SIPENAL.
    </p>

    <a href="{{ route('login') }}" class="btn">
        Kembali ke Login
    </a>

</div>

</body>
</html>