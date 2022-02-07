<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $gender = $this->faker->randomElement(['male','female']);
        $roles = ['teacher', 'student'];
        $role = $roles[rand(0, count($roles)-1)];
        return [
            'surname' => $this->faker->lastName($gender),
            'name' => $this->faker->firstName($gender),
            'patronymic' => $this->faker->middleName($gender),
            'email' => $this->faker->unique()->safeEmail(),
            'password' => bcrypt('password'),  // password
            'role' => $role,
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
    /**
    * Состояние для учетной записи Учебной части
    */
    public function training()
    {
        return $this->state(function (array $attributes) {
            return [
                  'email' => 'training@test.ru',
                  'password' => bcrypt('12'),
                  'role' => 'training',
            ];
        });
    }
    /**
    * Состояние для учетной записи преподавателя
    */
    public function teacher()
    {
        return $this->state(function (array $attributes) {
            return [
                  'email' => 'teacher@test.ru',
                  'password' => bcrypt('13'),
                  'role' => 'teacher',
            ];
        });
    }
    /**
    * Состояние для учетной записи студента
    */
    public function student()
    {
        return $this->state(function (array $attributes) {
            $gender = $this->faker->randomElement(['male','female']);
            return [
                'surname' => $this->faker->lastName($gender),
                'name' => $this->faker->firstName($gender),
                'patronymic' => $this->faker->middleName($gender),
                'email' => $this->faker->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => bcrypt('14'),
                'role' => 'student',
                'remember_token' => Str::random(10),
            ];
        });
    }
}

