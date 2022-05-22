<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

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

    public function createGroupByName(string $groupName)
    {
        return $this->state(function (array $attributes) use ($groupName) {
            return [
                'namegroup' => $groupName
            ];
        });
    }
}
