<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Testing Name',
            'email' => 'testingemail@example.com',
        ]);

        User::factory()
            ->count(50)
            ->create();

        Product::factory()
            ->count(100)
            ->create();
    }
}
