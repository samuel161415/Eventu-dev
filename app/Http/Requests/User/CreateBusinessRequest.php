<?php

namespace App\Http\Requests\User;

use App\Rules\UserAlreadyHasBusiness;
use Illuminate\Foundation\Http\FormRequest;

class CreateBusinessRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = $this->route('user');

        return [
            new UserAlreadyHasBusiness($user),
            'name' => 'required|string|max:255',
            'slogan' => 'nullable|string|max:255',
            'short_description' => 'nullable|string',
            'city' => 'required|string|max:255',
            'district' => 'required|string|max:255',
            'address' => 'required|string',
            'profile_picture_url' => 'nullable|url',
            'cover_photo_url' => 'nullable|url',
            'phone' => 'nullable|string|max:255',
            'email' => 'required|string|email|max:255',
            'website_url' => 'nullable|url',
            'fiscal_attribute' => 'nullable|string|max:255',
            'identification_code' => 'nullable|string|max:255',
            'control_digit' => 'nullable|string|max:255',
            'registration_prefix' => 'nullable|string|max:255',
            'county_code' => 'nullable|string|max:255',
            'order_number' => 'nullable|integer',
            'registration_year' => 'nullable|date_format:Y'
        ];
    }
}
