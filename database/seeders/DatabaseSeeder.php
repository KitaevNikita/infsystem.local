<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            DisciplinesTableSeeder::class,
            // LessonsTableSeeder::class,
            // GroupsTableSeeder::class,
            SpecializationsTableSeeder::class,
            StudentsTableSeeder::class,
            SummarylistsTableSeeder::class,
            AcademicsTableSeeder::class,
            RatesTableSeeder::class,
        ]);
    }
}
