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
        $namegroups = [
            '1ИС', '2ИС', '3ИС', '4ИС',
            '1ПК', '2ПК', '3ПК', '4ПК',
            '1МР', '2МР', '3МР',
            '1НК', '2НК', '3НК', '4НК',
            '1ДО', '2ДО', '3ДО', '4ДО',
            '1Ф', '2Ф', '3Ф', '4Ф',
        ];
        return [
            'namegroup' => $namegroups[rand(0, count($namegroups) - 1)],
        ];
    }

    public function createGroupByName(string $groupName, Specialization $specialization, Discipline $discipline)
    {
        return $this->state(function (array $attributes) use ($groupName, $specialization, $discipline) {
            return [
                'namegroup' => $groupName,
                'specialization_id' => $specialization->id,
                'discipline_id' => $discipline->id
            ];
        });
    }
}
