<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\TextCategory;
class TextCategoryCheck implements Rule
{

    public function __construct()
    {
    }

    public function passes($attribute, $name)
    {
        $count = TextCategory::where('name', $name)->count();
        if ($count > 0) {
            return false;
        }

        return true;
    }

    public function message()
    {
        return 'カテゴリ名が重複しています';
    }
}
