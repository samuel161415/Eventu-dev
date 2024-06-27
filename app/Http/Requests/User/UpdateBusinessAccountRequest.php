<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBusinessAccountRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        dd('here');
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'sometimes|required|string|max:255',
            'slogan' => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'city' => 'sometimes|required|string|max:255',
            'district' => 'sometimes|required|string|max:255',
            'address' => 'sometimes|required|string',
            'profile_picture_url' => 'nullable|url',
            'cover_photo_url' => 'nullable|url',
            'phone' => 'nullable|string|max:255',
            'email' => 'nullable|string|email|max:255',
            'website_url' => 'nullable|url',
        ];
    }
}
