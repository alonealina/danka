<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Banner;
class PriorityCheck implements Rule
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
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
        $banner_id = $this->id;
        if ($value != 7) {
            $count = Banner::where('priority', $value)->where('id', '<>', $banner_id)->count();
            if ($count > 0) {
                return false;
            }
        }
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return '表示順位が重複しています';
    }
}
