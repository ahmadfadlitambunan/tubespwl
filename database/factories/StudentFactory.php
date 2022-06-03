<?php

namespace Database\Factories;

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
        return [
            'name' => $this->faker->name(),
            'grade_id' => $this->faker->numberBetween(1, 6),
            'nis' => $this->faker->unique()->numerify('21###'),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'image' => 'profile-images/profile.png',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ];
    }
}
