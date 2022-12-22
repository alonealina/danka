<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\AdminUser;
class LoginIdCheck implements Rule
{
    private $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function passes($attribute, $value)
    {
        $login_id = $this->id;

        $count = AdminUser::where('login_id', $value)->where('id', '<>', $login_id)->count();
        if ($count > 0) {
            return false;
        }

        return true;
    }

    public function message()
    {
        return 'IDが重複しています';
    }
}
