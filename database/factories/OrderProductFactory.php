<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'amount' => $this->faker->randomNumber(1),
            'price' => $this->faker->randomNumber(5),
        ];
    }
}
