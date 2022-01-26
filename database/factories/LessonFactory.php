<?php

namespace Database\Factories;

use App\Models\Lesson;
use App\Models\Group;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types = ["Теоретический","Практический","Теоретико-практически"];
        return [
            'date' => $this->faker->date(),
            'topic' => $this->faker->realText($maxNdChars = 50, $indexSize = 2),
            'type' => $types[rand(0, count($types)-1)],
            'number_of_hours' => mt_rand(1, 2),
        ];
    }
}
