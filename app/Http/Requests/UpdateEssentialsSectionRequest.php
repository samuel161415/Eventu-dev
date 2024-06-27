<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEssentialsSectionRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'city' => 'required|string',
            'district' => 'required|string',
            'address' => 'required|string',
            'specific' => 'nullable|string',
        ];
    }

    public function messages()
    {
        return [
            'city.required' => 'Câmpul Oraș este obligatoriu.',
            'district.required' => 'Câmpul Zonă este obligatoriu.',
            'address.required' => 'Câmpul Adresă este obligatoriu.',
        ];
    }
}
