<?php

namespace Database\Factories;

use App\Constants\OrderConstants;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'reference' => Str::uuid()->toString(),
            'price' => $this->faker->randomNumber(5),
            'status' => OrderConstants::PENDING,
            'process_url' => $this->faker->url(),
            'request_id' => $this->faker->randomNumber(5),
        ];
    }
}
