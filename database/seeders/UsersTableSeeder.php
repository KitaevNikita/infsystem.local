<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()
            ->count(1)
            ->training()
            ->create();
        User::factory()
            ->count(1)
            ->teacher()
            ->create();
        User::factory()
            ->count(1)
            ->classteacher()
            ->create();
    }
}
