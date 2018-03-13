<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use PragmaRX\Countries\Package\Countries;

class ValidCountryRule implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return ! Countries::where('name.common', $value)->isEmpty();
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The given Country is not valid';
    }
}
