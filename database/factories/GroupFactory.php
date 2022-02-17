<?php

namespace Database\Factories;

use App\Models\Group;
use App\Models\Specialization;
use App\Models\Discipline;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class GroupFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [];
    }

    public function createGroupByName(string $groupName, Specialization $specialization)
    {
        return $this->state(function (array $attributes) use ($groupName, $specialization) {
            return [
                'namegroup' => $groupName,
                'specialization_id' => $specialization->id,
            ];
        });
    }
}
