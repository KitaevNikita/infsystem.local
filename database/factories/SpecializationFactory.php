<?php

namespace Database\Factories;

use App\Models\Specialization;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
