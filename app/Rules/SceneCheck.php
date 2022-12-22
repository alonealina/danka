<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Models\Scene;
class SceneCheck implements Rule
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
        $scene_id = $this->id;

        $count = Scene::where('name', $value)->where('id', '<>', $scene_id)->count();
        if ($count > 0) {
            return false;
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
        return 'タイトルが重複しています';
    }
}
