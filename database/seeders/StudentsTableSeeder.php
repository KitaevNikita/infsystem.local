<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Student;
use App\Models\Lesson;
use App\Models\Group;
use Illuminate\Database\Seeder;

class StudentsTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $students = User::where('role', 'student')->get();
        $groups = Group::all();
        foreach ($students as $student) {
            Student::factory()
                ->count(1)
                ->for($student)
                ->for($groups[rand(0, count($groups) - 1)])
                ->create();
        }
    }
}
