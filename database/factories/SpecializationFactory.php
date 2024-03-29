<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SpecializationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [];
    }

    public function createSpecializationByName(string $specializationName)
    {
        return $this->state(function (array $attributes) use ($specializationName) {
            return [
                'namespec' => $specializationName
            ];
        });
    }
}
