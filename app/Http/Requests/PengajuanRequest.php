<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use App\Models\Pengaturan;

class PengajuanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('peminjaman.ajukan');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $maksHari = (int) Pengaturan::ambil('maks_hari_pinjam', 30);
        $batasAkhir = now()->addDays($maksHari)->toDateString();

        return [
            'tgl_pinjam' => [
                'required',
                'date',
                'after_or_equal:today',
            ],

            'tgl_harus_kembali' => [
                'required',
                'date',
                'after_or_equal:tgl_pinjam',
                'before_or_equal:' . $batasAkhir,
            ],

            'keperluan' => [
                'nullable',
                'string',
                'max:500',
            ],
        ];
    }
}
