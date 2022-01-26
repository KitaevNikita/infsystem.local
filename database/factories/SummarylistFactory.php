<?php

namespace Database\Factories;

use App\Models\Summarylist;
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
        $estimations = [
            '2',
            '3',
            '4',
            '5',
        ];
        $interims = [
            'Зачет',
            'Дифференцированный зачет',
            'Экзамен'
        ];
        $student = Student::inRandomOrder()
        ->first();
        $discipline = Discipline::inRandomOrder()
        ->first();
        return [
            'interim' => $interims[rand(0, count($interims)-1)],
            'estimation' => $estimations[rand(0, count($estimations)-1)],
            'discipline_id' => $discipline->id,
            'student_id' => $student->id,
        ];
    }
}
