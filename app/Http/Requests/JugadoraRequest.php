<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Carbon\Carbon;

class JugadoraRequest extends FormRequest
{
    public function authorize(): bool { return true; }

    public function rules(): array
    {
        return [
            'nom' => 'required|min:3',
            'equip_id' => 'required|exists:equips,id',
            'dorsal' => 'required|integer|min:1|max:99',
            'data_naixement' => [
                'required',
                'date',
                'before_or_equal:' . Carbon::now()->subYears(16)->format('Y-m-d')
            ],
            'foto' => 'nullable|image|mimes:png|max:2048',
        ];
    }

    public function messages(): array
    {
        return [
            'data_naixement.before_or_equal' => 'La jugadora ha de tindre almenys 16 anys.',
            'foto.mimes' => 'La foto ha de ser un fitxer de tipus .png',
            'foto.max' => 'La foto no pot ocupar més de 2MB.',
        ];
    }
}
