<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\AdminUser;
class LoginCheck implements Rule
{
    private $password;

    public function __construct($password)
    {
        $this->password = $password;
    }

    public function passes($attribute, $login_id)
    {
        $password = $this->password;

        $count = AdminUser::where('login_id', $login_id)->where('password', $password)->count();
        if ($count > 0) {
            return true;
        }

        return false;
    }

    public function message()
    {
        return nl2br('ログインできませんでした。<br>IDとパスワードを確認してください');
    }
}
