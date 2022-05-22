<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SummarylistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'interim' => (string)rand(2, 5),
            'estimation' => (string)rand(2, 5)
        ];
    }
}
