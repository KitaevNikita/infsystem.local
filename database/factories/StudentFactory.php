<?php

namespace Database\Factories;

use App\Models\Student;
use App\Models\User;
use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class StudentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $userStudent = User::factory()->count(1)->student()->create()[0];
        return [
            'user_id' => $userStudent->id,
            'number' => mt_rand(100, 999),
        ];
    }
}
