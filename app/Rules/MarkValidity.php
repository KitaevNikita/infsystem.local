<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class MarkValidity implements Rule
{
    private const availableChars = ['5', '4', '3', '2', 'н', 'Н'];

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
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
        if (!in_array($value[0], self::availableChars)) {
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
        return 'Ведённое вами значение вне диапозона допустимых значений: 5, 4, 3, 2, н, Н.';
    }
}
