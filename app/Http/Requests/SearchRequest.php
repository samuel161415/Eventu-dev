<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SearchRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        
        return [
            'capacity' => 'nullable|integer|min:0',
            'tags' => 'nullable|array',
            'tags.*' => 'string|exists:tags,name',
            'eventType' => 'nullable',
            'eventType.*' => 'string|exists:event_categories,name',
            'location' => 'nullable|string',
        ];
    }

}
