<?php

namespace Database\Seeders;

use App\Models\Discipline;
use App\Models\Lesson;
use App\Models\Group;
use Illuminate\Database\Seeder;

class DisciplinesTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Discipline::factory()
            ->count(20)
            ->create();
    }
}
