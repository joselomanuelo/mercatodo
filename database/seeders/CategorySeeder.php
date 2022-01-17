<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        Category::factory()->Has(Product::factory()->count(50))
            ->create([
                'name' => trans('categories.cleaning'),
            ]);

        Category::factory()->Has(Product::factory()->count(50))
            ->create([
                'name' => trans('categories.food'),
            ]);
    }
}
