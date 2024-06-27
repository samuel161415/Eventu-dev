<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOfferSectionRequest extends FormRequest
{
    public function authorize()
    {
        // dd($this->all());
        return true;
    }

    public function rules()
    {
        return [
            'min_people' => 'nullable|integer|min:0',
            'max_people' => 'nullable|integer|min:' . ($this->input('min_people') ?: '0'),
            'pret_min_botez' => 'nullable|integer|min:0',
            'pret_min_nunta' => 'nullable|integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'min_people.integer' => 'Câmpul Invitati - Minim trebuie să fie un număr întreg.',
            'min_people.min' => 'Câmpul Invitati - Minim trebuie să fie cel puțin :min.',
            'max_people.integer' => 'Câmpul Invitati - Maxim trebuie să fie un număr întreg.',
            'max_people.min' => 'Câmpul Invitati - Maxim trebuie să fie cel puțin :min, sau lăsat gol dacă nu există restricții.',
            'pret_min_botez.integer' => 'Câmpul Botez - Preț minim trebuie să fie un număr întreg.',
            'pret_min_botez.min' => 'Câmpul Botez - Preț minim trebuie să fie cel puțin :min.',
            'pret_min_nunta.integer' => 'Câmpul Nunta - Preț minim trebuie să fie un număr întreg.',
            'pret_min_nunta.min' => 'Câmpul Nunta - Preț minim trebuie să fie cel puțin :min.',
        ];
    }
}
