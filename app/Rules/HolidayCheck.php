<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
class HolidayCheck implements Rule
{
    private $array;

    public function __construct($array)
    {
        $this->array = $array;
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
        $array = $this->array;
        return in_array(1, $array) ? true : false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '定休日を選択してください';
    }
}
