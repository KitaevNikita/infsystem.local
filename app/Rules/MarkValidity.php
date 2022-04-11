<?php

namespace App\Rules;

use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Validation\Rule;

class MarkValidity implements Rule
{
    private const availableCharsForAttendance = ['5', '4', '3', '2', 'н', 'Н'];
    
    private const availableChars = ['5', '4', '3', '2'];

    private $checkAttendance = false;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($checkAttendance)
    {
        $this->checkAttendance = $checkAttendance;
        Log::info($this->checkAttendance);
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
        $localAvailableChars = [];
        if ($this->checkAttendance) {
            $localAvailableChars = self::availableCharsForAttendance; 
        } else {
            $localAvailableChars = self::availableChars;
        }
        Log::info($localAvailableChars);
        if (!in_array($value, self::availableChars)) {
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
