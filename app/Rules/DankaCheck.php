<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Danka;
class DankaCheck implements Rule
{
    private $name;
    private $zip;

    public function __construct($name, $tel)
    {
        $this->name = $name;
        $this->zip = $zip;
    }

    public function passes($attribute, $name)
    {
        $count = Danka::where('name', $this->name)->where('zip', $this->zip)->count();
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
