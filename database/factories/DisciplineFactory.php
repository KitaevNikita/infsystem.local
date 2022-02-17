<?php

namespace Database\Factories;

use App\Models\Discipline;
use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DisciplineFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $certifications = [
            'Зачет',
            'Дифференцированный зачет',
            'Экзамен'
        ];
        return [
            'teacher' => $this->faker->name(),
            'number_hours' => mt_rand(30, 275),
            'certification' => $certifications[rand(0, count($certifications)-1)],
        ];
    }

    public function createDisciplineByName(string $disciplineName)
    {
        return $this->state(function (array $attributes) use ($disciplineName) {
            return [
                'name_of_the_discipline' => $disciplineName
            ];
        });
    }
}

