<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
class PhoneCheck implements Rule
{
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return preg_match('/^(([0-9]{2,4}-[0-9]{2,4}-[0-9]{3,4})|([0-9]{8,11}))$/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '電話番号はハイフンありかなしで8~11個の数字で入力してください。';
    }
}
