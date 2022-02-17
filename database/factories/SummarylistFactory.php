<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\Discipline;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SummarylistFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $interims = [
            'Зачет',
            'Дифференцированный зачет',
            'Экзамен'
        ];
        return [
            'interim' => $interims[rand(0, count($interims) - 1)],
            'estimation' => (string)rand(2,5)
        ];
    }
}
