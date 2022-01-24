<?php

namespace Database\Factories;

use App\Models\Discipline;
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
        $disciplines = ['РВиА ПО ОН', 'ДиАСО', 'Образовательные системы', 'БЖ', 'Информационная безопасность', 'Физическая культура', 'Педагогика', 'Психология', 'Русский язык', 'Марийский язык', 'РиПИП', 'ПОПД', 'ОПД', 'Философия', 'Математика', 'Информатика и ИКТ', 'Литература', 'ТОДО', 'Языки программирования', 'Основы HTML'];
        return [
            'name_of_the_discipline' => $disciplines[mt_rand(0, count($disciplines)-1)],
            'teacher' => $this->faker->name(),
            'number_hours' => mt_rand(30, 275),
            'certification' => $certifications[rand(0, count($certifications)-1)],
        ];
    }
}

