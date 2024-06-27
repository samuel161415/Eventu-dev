<?php

namespace App\Rules;

use Closure;
use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;

class UserAlreadyHasBusiness implements ValidationRule
{
    public function __construct(
        private User $user
    ){
    }
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if($this->user->business_id !== null){
            $fail('User already has a business.');
        }
    }
}
