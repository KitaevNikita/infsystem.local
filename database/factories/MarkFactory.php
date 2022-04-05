<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class MarkFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $marks = ['2', '3', '4', '5', 'Н', 'н'];
        return [
            'mark' => $marks[rand(0, count($marks) - 1)]
        ];
    }
}
