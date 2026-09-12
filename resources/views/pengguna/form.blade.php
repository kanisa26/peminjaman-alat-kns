@extends('layouts.utama')

@section('judul', $pengguna->exists ? 'Ubah Pengguna' : 'Tambah Pengguna')

@section('konten')

<div class="row justify-content-center">

    <div class="col-md-8">

        <div class="card">

            <div class="card-body">

                <h5 class="card-title mb-2">
                    {{ $pengguna->exists ? 'Ubah Data Pengguna' : 'Tambah Data Pengguna' }}
                </h5>

                {{-- KETERANGAN DI BAWAH JUDUL --}}
                <div class="text-muted small mb-4">
                    <span class="text-danger">*</span>
                    Pastikan data pengguna yang dimasukkan sudah benar dan sesuai.
                    Periksa kembali data sebelum menekan tombol Simpan.
                </div>

                <form
                    method="POST"
                    action="{{ $pengguna->exists ? route('pengguna.update', $pengguna) : route('pengguna.store') }}"
                    novalidate
                >

                    @csrf

                    @if ($pengguna->exists)
                        @method('PUT')
                    @endif

                    {{-- NAMA & USERNAME --}}
                    <div class="row">

                        <div class="col-md-6">

                            <x-input
                                label="Nama Lengkap"
                                name="nama"
                                :value="$pengguna->nama"
                                wajib
                            />

                        </div>

                        <div class="col-md-6">

                            <x-input
                                label="Nama Pengguna"
                                name="username"
                                :value="$pengguna->username"
                                wajib
                            />

                        </div>

                    </div>

                    {{-- EMAIL & NOMOR TELEPON --}}
                    <div class="row">

                        <div class="col-md-6">

                            <x-input
                                label="Email"
                                name="email"
                                :value="$pengguna->email"
                                type="email"
                                wajib
                            />

                        </div>

                        <div class="col-md-6">

                            <x-input
                                label="Nomor Telepon"
                                name="no_telp"
                                :value="$pengguna->no_telp"
                                wajib
                            />

                        </div>

                    </div>

                    @if ($pengguna->exists)

                        <div class="text-muted small mb-3">
                            Password kosongkan bila tidak diganti.
                        </div>

                    @endif

                    {{-- PASSWORD --}}
                    <div class="row">

                        <div class="col-md-6">

                            <x-input
                                label="Kata Sandi"
                                name="password"
                                type="password"
                                wajib
                            />

                        </div>

                        <div class="col-md-6">

                            <x-input
                                label="Konfirmasi Kata Sandi"
                                name="password_confirmation"
                                type="password"
                                wajib
                            />

                        </div>

                    </div>

                    {{-- PERAN & STATUS --}}
                    <div class="row">

                        <div class="col-md-8 mb-3">

                            <label for="peran" class="form-label">
                                Peran <span class="text-danger">*</span>
                            </label>

                            <select
                                class="form-select @error('peran') is-invalid @enderror"
                                name="peran"
                                id="peran"
                                required
                            >

                                <option value="">
                                    Pilih Peran
                                </option>

                                @foreach ($daftarPeran as $pilihanPeran)

                                    <option
                                        value="{{ $pilihanPeran->name }}"
                                        {{ old('peran', $pengguna->roles->first()?->name) === $pilihanPeran->name ? 'selected' : '' }}
                                    >
                                        {{ ucfirst($pilihanPeran->name) }}
                                    </option>

                                @endforeach

                            </select>

                            @error('peran')

                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>

                            @enderror

                        </div>

                        <div class="col-md-4 mb-3">
<x-select
    label="Status Aktif"
    name="is_aktif"
    :value="$pengguna->is_aktif"
    placeholder="Pilih status aktif"
    wajib
    :opsi="[
        ['key' => 1, 'label' => 'Aktif'],
        ['key' => 0, 'label' => 'Nonaktif'],
    ]"
/>

                        </div>

                    </div>

                    <button
                        type="submit"
                        class="btn btn-primary"
                    >
                        Simpan
                    </button>

                    <a
                        href="{{ route('pengguna.index') }}"
                        class="btn btn-secondary"
                    >
                        Batal
                    </a>

                </form>

            </div>

        </div>

    </div>

</div>

@endsection