<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Testing Name',
            'email' => 'testingemail@example.com',
            'role' => 'admin',
        ]);

        User::factory()
            ->count(50)
            ->create();

        Product::factory()
            ->count(100)
            ->create();
    }
}
