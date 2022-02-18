<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class HaveEnoughKips implements Rule
{
    public $price;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($price)
    {
        $this->price = $price;
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
        return $this->price * $value <= auth()->user()->kips;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "Vous n'avez pas assez de kips.";
    }
}
