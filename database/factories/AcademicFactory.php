<?php

namespace Database\Factories;

use App\Models\Academic;
use App\Models\Student;
use App\Models\Lesson;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class AcademicFactory extends Factory
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
            'estimation' => mt_rand(2, 5),
            'lesson_id' => $lesson->id,
            'student_id' => $student->id,
        ];
    }
}
