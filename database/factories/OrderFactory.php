<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'reference' => Str::uuid()->toString(),
            'price' => $this->faker->randomNumber(5),
            'status' => 'PENDING',
            'process_url' => $this->faker->url(),
            'request_id' => $this->faker->randomNumber(5),
        ];
    }
}
