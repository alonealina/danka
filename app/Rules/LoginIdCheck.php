<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\AdminUser;
class LoginIdCheck implements Rule
{

    public function __construct()
    {
    }

    public function passes($attribute, $login_id)
    {
        $count = AdminUser::where('login_id', $login_id)->count();
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
