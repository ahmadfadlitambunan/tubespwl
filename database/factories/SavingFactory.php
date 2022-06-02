<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SavingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'student_id' => $this->faker->numberBetween(1, 60),
            'method_id' => 2,
            'payment_id' => $this->faker->numberBetween(1, 3),
            'deposit' => $this->faker->numerify('##000')
        ];
    }
}
