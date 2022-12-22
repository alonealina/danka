<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
class ZipCheck implements Rule
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
        return preg_match('/^(([0-9]{3}-[0-9]{4}))$/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '郵便番号はハイフンありで7個の数字で入力してください。';
    }
}
