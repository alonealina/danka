<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Scene;
class AlphaNumCheck implements Rule
{
    private $id;

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
        if (preg_match("/^([a-zA-Z]+(?=[0-9])|[0-9]+(?=[a-zA-Z]))[0-9a-zA-Z]+$/", $value)) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '半角の英字・数字それぞれを最低1文字以上含めて入力してください';
    }
}
