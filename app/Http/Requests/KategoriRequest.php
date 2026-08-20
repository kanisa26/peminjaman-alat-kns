<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KategoriRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('kategori.kelola');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $kategoriYangDiubah = $this->route('kategori');

        return [
            'nama' => [
                'required',
                'string',
                'max:100',
                Rule::unique('kategori', 'nama')
                    ->ignore($kategoriYangDiubah),
            ],
            'deskripsi' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'nama.required' => 'Nama kategori wajib diisi.',
            'nama.unique' => 'Nama kategori tersebut sudah terdaftar.',
            'nama.max' => 'Nama kategori maksimal 100 karakter.',
        ];
    }
}
