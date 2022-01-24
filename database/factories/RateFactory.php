<?php

namespace Database\Factories;

use App\Models\Rate;
use App\Models\Student;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RateFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $student = Student::inRandomOrder()
        ->first();
        $lesson = Lesson::inRandomOrder()
        ->first();
        return [
            'mark' => $this->faker->boolean($chanceOfGettingTrue = 50),
            'lesson_id' => $lesson->id,
            'student_id' => $student->id,
        ];
    }
}
