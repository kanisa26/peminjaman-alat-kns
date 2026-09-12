<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class KoreksiPengembalianRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('pengembalian.kelola');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'denda_kerusakan' => ['required', 'numeric', 'min:0'],

            'status_pembayaran' => [
                'required',
                Rule::in([
                    'belum_dibayar',
                    'sudah_dibayar',
                ]),
            ],

            'catatan' => ['nullable', 'string', 'max:500'],
        ];
    }
}