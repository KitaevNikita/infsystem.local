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
        $namespecs = [
            'Преподавание в начальных классах', 
            'Физическая культура', 
            'Дошкольное образование',
            'Информационные системы и технологии',
            'Мастер по ремонту и обслуживанию автомобилей', 
            'Повар, кондитер'
        ];
        return [
            'namespec' => $namespecs[rand(0, count($namespecs)-1)],
        ];
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
