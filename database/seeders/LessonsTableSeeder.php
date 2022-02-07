<?php

namespace Database\Seeders;

use App\Models\Lesson;
use Illuminate\Database\Seeder;

class LessonsTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $lessons = Lesson::all();
        foreach($lessons as $lesson)
        {
            $lesson->students()->attach($lesson->group->students);
        }
    }
}
