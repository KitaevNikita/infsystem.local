<?php

namespace Database\Seeders;

use App\Models\Academic;
use Illuminate\Database\Seeder;

class AcademicsTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Academic::factory()
            ->count(13)
            ->create();
    }
}
