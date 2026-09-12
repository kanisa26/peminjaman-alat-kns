<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Menampilkan halaman profil.
     */
    public function index()
    {
        $user = auth()->user();

        return view('profil.index', compact('user'));
    }


    /**
     * Mengubah informasi profil dan foto.
     */
    public function update(Request $request)
    {
        $user = auth()->user();

        $request->validate([
            'nama' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:100'],

            // Foto tidak wajib diupload
            'foto' => [
                'nullable',
                'image',
                'mimes:jpg,jpeg,png',
                'max:2048',
            ],

        ], [

            'nama.required' => 'Nama wajib diisi.',
            'nama.max' => 'Nama maksimal 100 karakter.',

            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.max' => 'Email maksimal 100 karakter.',

            'foto.image' => 'File yang dipilih harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat JPG, JPEG, atau PNG.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
        ]);


        /*
        |--------------------------------------------------------------------------
        | SIMPAN FOTO
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('foto')) {

            // Hapus foto lama jika ada
            if (
                $user->foto &&
                Storage::disk('public')->exists($user->foto)
            ) {
                Storage::disk('public')->delete($user->foto);
            }


            // Simpan foto baru
            $path = $request->file('foto')
                ->store('foto-profil', 'public');


            // Simpan lokasi foto ke database
            $user->foto = $path;
        }


        /*
        |--------------------------------------------------------------------------
        | UPDATE DATA PROFIL
        |--------------------------------------------------------------------------
        */

        $user->nama = $request->nama;
        $user->email = $request->email;

        $user->save();


        return back()->with(
            'sukses',
            'Profil berhasil diperbarui.'
        );
    }


    /**
     * Mengubah password.
     */
    public function updatePassword(Request $request)
    {
        $request->validate([

            'password_lama' => [
                'required',
                'current_password',
            ],

            'password_baru' => [
                'required',
                'min:8',
            ],

            'password_baru_confirmation' => [
                'required',
                'same:password_baru',
            ],

        ], [

            'password_lama.required' =>
                'Password saat ini wajib diisi.',

            'password_lama.current_password' =>
                'Password saat ini tidak sesuai.',

            'password_baru.required' =>
                'Password baru wajib diisi.',

            'password_baru.min' =>
                'Password baru minimal 8 karakter.',

            'password_baru_confirmation.required' =>
                'Konfirmasi password wajib diisi.',

            'password_baru_confirmation.same' =>
                'Konfirmasi password tidak sama.',
        ]);


        $user = auth()->user();


        $user->password = Hash::make(
            $request->password_baru
        );

        $user->save();


        return back()->with(
            'sukses_password',
            'Password berhasil diubah.'
        );
    }
}