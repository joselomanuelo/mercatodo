<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@mercatodo.com',
        ]);

        $admin->assignRole('admin');

        $users = User::factory()
            ->count(100)
            ->create();

        foreach ($users as $user) {
            $user->assignRole('buyer');
        }
    }
}
