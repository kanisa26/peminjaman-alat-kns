<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PenggunaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('user.kelola');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $penggunaYangDiubah = $this->route('pengguna');
        $sedangMengubah = $penggunaYangDiubah !== null;

        return [
            'nama' => [
                'required',
                'string',
                'max:100',
            ],

            'username' => [
                'required',
                'string',
                'max:50',
                'alpha_dash',
                Rule::unique('users', 'username')
                    ->ignore($penggunaYangDiubah),
            ],

            'email' => [
                'required',
                'email',
                'max:100',
                Rule::unique('users', 'email')
                    ->ignore($penggunaYangDiubah),
            ],

            'no_telp' => [
    'required',
    'numeric',
    'digits_between:10,15',
],

            'password' => [
                $sedangMengubah ? 'nullable' : 'required',
                'string',
                'min:8',
                'confirmed',
            ],

            'password_confirmation' => [
                $sedangMengubah ? 'nullable' : 'required',
                'same:password',
            ],

            'peran' => [
                'required',
                'exists:roles,name',
            ],

            'is_aktif' => [
                'required',
                'boolean',
            ],
        ];
    }

    /**
     * Pesan validasi.
     */
    public function messages(): array
    {
        return [

        'no_telp.required' =>
            'Nomor telepon wajib diisi.',

        'no_telp.numeric' =>
            'Nomor telepon hanya boleh berisi angka.',

        'no_telp.digits_between' =>
            'Nomor telepon harus terdiri dari 10 sampai 15 angka.',
            'nama.required' => '*Wajib diisi',

            'username.required' => '*Wajib diisi',
            'username.unique' => 'Nama pengguna tersebut sudah dipakai.',
            'username.alpha_dash' => 'Nama pengguna hanya boleh berisi huruf, angka, garis bawah, dan tanda hubung.',

            'email.required' => '*Wajib diisi',
            'email.email' => 'Format email tidak valid.',

            'password.required' => '*Wajib diisi',
            'password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
            'password.min' => 'Kata sandi minimal 8 karakter.',

            'password_confirmation.required' => '*Wajib diisi',
            'password_confirmation.same' => 'Konfirmasi kata sandi tidak cocok.',

            'peran.required' => '* Wajib dipilih.',

            'is_aktif.required' => '* Wajib dipilih.',
        ];
    }
}
