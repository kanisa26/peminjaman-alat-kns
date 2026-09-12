<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class KoreksiPeminjamanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('peminjaman.kelola');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tgl_pinjam'        => ['required', 'date'],
            'tgl_harus_kembali' => ['required', 'date', 'after_or_equal:tgl_pinjam'],
            'keperluan'         => ['nullable', 'string', 'max:500'],
            'alasan_tolak'      => ['nullable', 'string', 'max:500'],
        ];
    }
}
