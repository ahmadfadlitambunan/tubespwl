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
            'user_id' => $this->faker->numberBetween(1, 10),
            'student_id' => $this->faker->numberBetween(1, 60),
            'method_id' => $this->faker->randomElement(['1', '2']),
            'status' => $this->faker->randomElement(['1', '0']),
            'payment_id' => $this->faker->numberBetween(0, 3),
            'image' => 'saving-images/duit.JPEG',
            'created_at' => $this->faker->dateTimeThisYear(),
            'deposit' => $this->faker->numerify('##000')
        ];
    }
}
