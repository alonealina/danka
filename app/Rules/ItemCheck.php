<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Item;
class ItemCheck implements Rule
{
    private $category_id;
    private $item_id;

    public function __construct($category_id, $item_id)
    {
        $this->category_id = $category_id;
        $this->item_id = $item_id;
    }

    public function passes($attribute, $name)
    {
        $category_id = $this->category_id;
        $item_id = $this->item_id;

        if(isset($item_id)) {
            $count = Item::where('category_id', $category_id)->where('detail', $name)->where('id', '!=', $item_id)->count();
        } else {
            $count = Item::where('category_id', $category_id)->where('detail', $name)->count();
        }

        if ($count > 0) {
            return false;
        }

        return true;
    }

    public function message()
    {
        return '商品が重複しています';
    }
}
