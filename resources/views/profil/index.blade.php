@extends('layouts.utama')

@section('judul', 'Profil Saya')

@section('konten')

<div class="container-fluid px-4 py-4">

    {{-- HEADER --}}
    <div class="mb-4">
        <h3 class="judul-halaman">
            Profil Saya
        </h3>

        <p class="text-muted mb-0">
            Kelola informasi akun dan keamanan password Anda.
        </p>
    </div>


    {{-- PESAN SUKSES PROFIL --}}
    @if(session('sukses_profil'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('sukses_profil') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif


    {{-- PESAN SUKSES PASSWORD --}}
    @if(session('sukses_password'))
        <div class="alert alert-success alert-dismissible fade show">
            <i class="bi bi-check-circle me-2"></i>
            {{ session('sukses_password') }}

            <button type="button"
                    class="btn-close"
                    data-bs-dismiss="alert">
            </button>
        </div>
    @endif


    {{-- ERROR --}}
    @if($errors->any())
    @php
        $pesanError = $errors->first();
    @endphp

    @if(str_starts_with($pesanError, 'AKUN DITOLAK|'))
        @php
            $bagian = explode('|', $pesanError, 2);
        @endphp

        <div class="alert alert-danger border-0 shadow-sm">
            <div class="d-flex align-items-start">
                <div class="me-3" style="font-size: 25px;">
                    ❌
                </div>

                <div>
                    <h6 class="fw-bold mb-1">
                        Akun Anda Ditolak
                    </h6>

                    <p class="mb-1">
                        Maaf, akun Anda belum dapat disetujui oleh Administrator.
                    </p>

                    <small>
                        <strong>Alasan:</strong>
                        {{ $bagian[1] ?? 'Tidak ada alasan.' }}
                    </small>
                </div>
            </div>
        </div>

    @else

        <div class="alert alert-danger border-0 shadow-sm">
            {{ $pesanError }}
        </div>

    @endif
@endif


    <div class="row g-4">

        {{-- =========================
             INFORMASI PROFIL
        ========================== --}}
        <div class="col-lg-7">

            <div class="card card-profil">

                <div class="card-body p-4">

                    {{-- JUDUL --}}
                    <div class="mb-4">

                        <h5 class="mb-1">
                            Informasi Profil
                        </h5>

                        <p class="text-muted mb-0">
                            Perbarui informasi akun Anda.
                        </p>

                    </div>


                    {{-- FORM PROFIL --}}
                    <form action="{{ route('profil.update') }}"
                          method="POST"
                          enctype="multipart/form-data">

                        @csrf
                        @method('PUT')


                        {{-- =========================
                             FOTO PROFIL
                        ========================== --}}
                        <div class="area-foto">

                            <div class="foto-wrapper">

                                @if($user->foto)

                                    <img src="{{ asset('storage/' . $user->foto) }}"
                                         alt="Foto Profil"
                                         class="foto-profil">

                                @else

                                    <div class="foto-default">
                                        <i class="bi bi-person-fill"></i>
                                    </div>

                                @endif


                                {{-- TOMBOL KAMERA --}}
                                <label for="foto"
                                       class="tombol-kamera"
                                       title="Pilih Foto">

                                    <i class="bi bi-camera-fill">📷</i>

                                </label>

                            </div>


                            <label for="foto"
                                   class="btn btn-outline-primary btn-pilih-foto">

                                <i class="bi bi-image me-1"></i>
                                Pilih Foto

                            </label>


                            <input type="file"
                                   name="foto"
                                   id="foto"
                                   class="d-none"
                                   accept=".jpg,.jpeg,.png,image/jpeg,image/png">


                            <div class="bantuan-foto">
                                Format JPG/PNG, maks. 2MB
                            </div>

                        </div>


                        {{-- NAMA --}}
                        <div class="mb-3">

                            <label class="form-label">
                                Nama
                            </label>

                            <input type="text"
                                   name="nama"
                                   class="form-control"
                                   value="{{ old('nama', $user->nama) }}"
                                   placeholder="Masukkan nama">

                        </div>


                        {{-- EMAIL --}}
                        <div class="mb-4">

                            <label class="form-label">
                                Email
                            </label>

                            <input type="email"
                                   name="email"
                                   class="form-control"
                                   value="{{ old('email', $user->email) }}"
                                   placeholder="Masukkan email">

                        </div>


                        <button type="submit"
                                class="btn btn-primary">

                            <i class="bi bi-check-lg me-1"></i>
                            Simpan Perubahan

                        </button>

                    </form>

                </div>

            </div>

        </div>


        {{-- =========================
             UBAH PASSWORD
        ========================== --}}
        <div class="col-lg-5">

            <div class="card card-profil">

                <div class="card-body p-4">

                    <div class="d-flex align-items-center mb-4">

                        <div class="ikon-password">

                            <i class="bi bi-shield-lock-fill"></i>

                        </div>

                        <div class="ms-3">

                            <h5 class="mb-1">
                                Ubah Password
                            </h5>

                            <p class="text-muted mb-0">
                                Perbarui password akun Anda.
                            </p>

                        </div>

                    </div>


                    <form action="{{ route('profil.password') }}"
                          method="POST">

                        @csrf
                        @method('PUT')


                        {{-- PASSWORD LAMA --}}
                        <div class="mb-3">

                            <label class="form-label">
                                Password Saat Ini
                            </label>

                            <input type="password"
                                   name="password_lama"
                                   class="form-control"
                                   placeholder="Masukkan password saat ini">

                        </div>


                        {{-- PASSWORD BARU --}}
                        <div class="mb-3">

                            <label class="form-label">
                                Password Baru
                            </label>

                            <input type="password"
                                   name="password_baru"
                                   class="form-control"
                                   placeholder="Minimal 8 karakter">

                        </div>


                        {{-- KONFIRMASI --}}
                        <div class="mb-4">

                            <label class="form-label">
                                Konfirmasi Password Baru
                            </label>

                            <input type="password"
                                   name="password_baru_confirmation"
                                   class="form-control"
                                   placeholder="Ulangi password baru">

                        </div>


                        <button type="submit"
                                class="btn btn-primary">

                            <i class="bi bi-key me-1"></i>
                            Ubah Password

                        </button>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>


<style>

/* ================================
   HALAMAN PROFIL
================================ */

.judul-halaman {
    font-weight: 700;
    color: #212529;
}


/* ================================
   CARD
================================ */

.card-profil {
    border: 1px solid #e5e7eb;
    border-radius: 14px;
    background: #ffffff;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
}


/* ================================
   AREA FOTO
================================ */

.area-foto {
    text-align: center;
    margin-bottom: 28px;
    padding: 8px 0 12px;
}


/* ================================
   WRAPPER FOTO
================================ */

.foto-wrapper {
    width: 130px;
    height: 130px;
    position: relative;
    margin: 0 auto 14px;
}


/* ================================
   FOTO
================================ */

.foto-profil,
.foto-default {
    width: 130px;
    height: 130px;
    border-radius: 50%;
    overflow: hidden;
}


/* FOTO ASLI */

.foto-profil {
    display: block;
    object-fit: cover;
    border: 4px solid #e9f2ff;
}


/* FOTO DEFAULT */

.foto-default {
    background-color: #e9f2ff;
    color: #0d6efd;

    display: flex;
    align-items: center;
    justify-content: center;

    border: 4px solid #e9f2ff;
}


.foto-default i {
    font-size: 65px;
}


/* ================================
   TOMBOL KAMERA
================================ */

.tombol-kamera {
    position: absolute;

    right: 2px;
    bottom: 2px;

    width: 38px;
    height: 38px;

    border-radius: 50%;

    background: #0d6efd;
    color: #ffffff;

    border: 3px solid #ffffff;

    display: flex;
    align-items: center;
    justify-content: center;

    cursor: pointer;

    transition: all 0.2s ease;
}


.tombol-kamera:hover {
    background: #0b5ed7;
    transform: scale(1.08);
}


.tombol-kamera i {
    font-size: 17px;
}


/* ================================
   TOMBOL PILIH FOTO
================================ */

.btn-pilih-foto {
    border-radius: 8px;
    font-weight: 600;
    padding: 7px 14px;
}


/* ================================
   TEKS BANTUAN FOTO
================================ */

.bantuan-foto {
    margin-top: 7px;

    font-size: 12px;

    color: #6b7280;
}


/* ================================
   ICON PASSWORD
================================ */

.ikon-password {
    width: 52px;
    height: 52px;

    border-radius: 12px;

    background-color: #e9f2ff;
    color: #0d6efd;

    display: flex;
    align-items: center;
    justify-content: center;

    font-size: 24px;
}


/* ================================
   FORM
================================ */

.card-profil .form-label {
    font-size: 14px;
    font-weight: 600;
    color: #374151;
}


.card-profil .form-control {
    border-radius: 8px;
    padding: 10px 12px;
    border-color: #d1d5db;
}


.card-profil .form-control:focus {
    border-color: #0d6efd;

    box-shadow:
        0 0 0 0.15rem
        rgba(13, 110, 253, 0.12);
}


/* ================================
   BUTTON
================================ */

.card-profil .btn-primary {
    border-radius: 8px;
    font-weight: 600;
    padding: 9px 16px;
}

</style>


{{-- PREVIEW FOTO SEBELUM DISIMPAN --}}
<script>

document.getElementById('foto').addEventListener('change', function(event) {

    const file = event.target.files[0];

    if (!file) {
        return;
    }

    const reader = new FileReader();

    reader.onload = function(e) {

        const wrapper = document.querySelector('.foto-wrapper');

        const fotoLama = wrapper.querySelector('.foto-profil');
        const fotoDefault = wrapper.querySelector('.foto-default');

        if (fotoLama) {
            fotoLama.src = e.target.result;
        } else if (fotoDefault) {

            const img = document.createElement('img');

            img.src = e.target.result;
            img.className = 'foto-profil';
            img.alt = 'Foto Profil';

            fotoDefault.replaceWith(img);
        }
    };

    reader.readAsDataURL(file);

});

</script>

@endsection