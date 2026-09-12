<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PengaturanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return $this->user()->can('pengaturan.kelola');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'tarif_denda_harian' => ['required', 'numeric', 'min:0'],
            'default_hari_pinjam' => ['required', 'integer', 'min:1', 'lte:maks_hari_pinjam'],
            'maks_hari_pinjam' => ['required', 'integer', 'min:1', 'max:365'],
            'nama_sekolah' => ['required', 'string', 'max:150'],
        ];
    }

    public function messages(): array
    {
        return [
            'default_hari_pinjam.lte' => 'Durasi bawaan tidak boleh melebihi durasi maksimal.',
            'maks_hari_pinjam.max' => 'Durasi maksimal tidak wajar, batas antarnya 365 hari.',
            'tarif_denda_harian.min' => 'Tarif denda tidak boleh bernilai negatif.',
        ];
    }

}
