<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class ProductFactory extends Factory
{
    public function definition(): array
    {
        return [
            'name' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'price' => $this->faker->randomNumber(5).'00',
            'stock' => $this->faker->randomNumber(4),
            'product_image' => Storage::disk('public')->put('uploads/products', new File('public/images/example.jpg')),
        ];
    }
}
