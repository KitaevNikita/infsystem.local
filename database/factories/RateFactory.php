<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class RateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $marks = [true, false];
        return [
            'mark' => $marks[rand(0, count($marks) - 1)]
        ];
    }
}
