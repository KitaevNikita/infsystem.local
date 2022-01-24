<?php

namespace Database\Seeders;

use App\Models\Summarylist;
use Illuminate\Database\Seeder;

class SummarylistsTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Summarylist::factory()
            ->count(13)
            ->create();
    }
}
