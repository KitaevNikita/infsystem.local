<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $types = ["Теоретический", "Практический", "Теоретико-практически"];
        return [
            'date' => $this->faker->date(),
            'topic' => $this->faker->realText($maxNdChars = 50, $indexSize = 2),
            'type' => $types[rand(0, count($types) - 1)],
            'number_of_hours' => mt_rand(1, 2),
        ];
    }

    public function createLessonByTopic(string $topic)
    {
        return $this->state(function (array $attributes) use ($topic) {
            return [
                'topic' => $topic
            ];
        });
    }
}
