<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Danka;
class DankaCheck implements Rule
{
    private $name;
    private $tel;

    public function __construct($name, $tel)
    {
        $this->name = $name;
        $this->tel = $tel;
    }

    public function passes($attribute, $name)
    {
        $count = Danka::where('name', $this->name)->where('tel', $this->tel)->count();
        if ($count > 0) {
            return false;
        }

        return true;
    }

    public function message()
    {
        return '檀家情報が既に登録されています';
    }
}
