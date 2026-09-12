<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Pendaftaran Berhasil - SIPENAL</title>

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

        .container {
            width: 100%;
            max-width: 650px;

            background: white;

            border-radius: 18px;

            padding: 45px;

            box-shadow:
                0 15px 45px rgba(0, 0, 0, 0.08);

            text-align: center;
        }


        /* ICON */

        .success-icon {
            width: 75px;
            height: 75px;

            margin: 0 auto 20px;

            border-radius: 50%;

            background: #dbeafe;

            color: #2563eb;

            display: flex;
            align-items: center;
            justify-content: center;

            font-size: 38px;
            font-weight: bold;
        }


        /* JUDUL */

        h1 {
            color: #0f172a;

            font-size: 28px;

            margin-bottom: 12px;
        }


        /* PESAN */

        .message {
            color: #64748b;

            font-size: 15px;

            line-height: 1.7;

            margin-bottom: 25px;
        }


        /* ALERT */

        .waiting {
            background: #eff6ff;

            border-left: 5px solid #2563eb;

            padding: 17px;

            border-radius: 10px;

            color: #1e40af;

            text-align: left;

            font-size: 14px;

            line-height: 1.6;

            margin-bottom: 30px;
        }


        /* DATA */

        .data-box {
            border: 1px solid #e2e8f0;

            border-radius: 12px;

            padding: 20px;

            text-align: left;

            margin-bottom: 30px;
        }

        .data-box h3 {
            color: #0f172a;

            font-size: 17px;

            margin-bottom: 15px;
        }

        .data-row {
            display: flex;

            justify-content: space-between;

            gap: 20px;

            padding: 11px 0;

            border-bottom: 1px solid #f1f5f9;
        }

        .data-row:last-child {
            border-bottom: none;
        }

        .label {
            color: #64748b;

            font-size: 13px;
        }

        .value {
            color: #0f172a;

            font-size: 14px;

            font-weight: 600;

            text-align: right;
        }


        /* STATUS */

        .status {
            display: inline-block;

            padding: 6px 12px;

            background: #fef3c7;

            color: #92400e;

            border-radius: 20px;

            font-size: 12px;

            font-weight: 600;
        }


        /* BUTTON */

        .buttons {
            display: flex;

            gap: 12px;
        }

        .btn {
            flex: 1;

            height: 46px;

            border-radius: 9px;

            display: flex;

            align-items: center;

            justify-content: center;

            text-decoration: none;

            font-size: 14px;

            font-weight: 600;
        }

        .btn-edit {
            background: #2563eb;

            color: white;
        }

        .btn-edit:hover {
            background: #1d4ed8;
        }

        .btn-home {
            background: white;

            color: #2563eb;

            border: 1px solid #2563eb;
        }

        .btn-home:hover {
            background: #eff6ff;
        }


        /* RESPONSIVE */

        @media(max-width: 600px) {

            .container {
                padding: 30px 22px;
            }

            .buttons {
                flex-direction: column;
            }

            .data-row {
                flex-direction: column;

                gap: 5px;
            }

            .value {
                text-align: left;
            }

        }

    </style>

</head>

<body>

<div class="container">

    <div class="success-icon">
        ✓
    </div>


    <h1>
        Pendaftaran Berhasil!
    </h1>


    <p class="message">
        Data akun kamu telah berhasil dikirim.
        Silakan periksa kembali data yang telah kamu masukkan
        di bawah ini.
    </p>


    <div class="waiting">

        <strong>
            ⏳ Mohon tunggu validasi
        </strong>

        <br>

        Akun kamu sedang menunggu validasi dari
        <strong>Administrator</strong>.
        Setelah akun divalidasi, kamu baru dapat
        menggunakan akun tersebut untuk login ke SIPENAL.

    </div>


    {{-- DATA YANG SUDAH DIISI --}}

    <div class="data-box">

        <h3>
            Data Pendaftaran
        </h3>


        <div class="data-row">

            <span class="label">
                Nama Lengkap
            </span>

            <span class="value">
                {{ $user->name }}
            </span>

        </div>


        <div class="data-row">

            <span class="label">
                Email
            </span>

            <span class="value">
                {{ $user->email }}
            </span>

        </div>


        <div class="data-row">

            <span class="label">
                Peran
            </span>

            <span class="value">
                Peminjam
            </span>

        </div>


        <div class="data-row">

            <span class="label">
                Status Akun
            </span>

            <span class="value">

                <span class="status">
                    Menunggu Validasi
                </span>

            </span>

        </div>

    </div>


    {{-- BUTTON --}}

    <div class="buttons">

        <a
            href="{{ route('register.edit', $user->id) }}"
            class="btn btn-edit"
        >
            ✏ Edit Data
        </a>


        <a
            href="{{ route('home') }}"
            class="btn btn-home"
        >
            ← Kembali ke Home
        </a>

    </div>

</div>

</body>

</html>