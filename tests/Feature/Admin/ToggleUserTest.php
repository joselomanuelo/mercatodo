<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ToggleUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Disable user can't do anything 
     *
     * @return void
     */
    public function test_disable_user_cant_do_anything(): void
    {
        $user = User::factory()->create([
            'disable_at' => now(),
        ]);

        $response = $this->actingAs($user)
            ->get('/');

        $this->assertGuest();

        $response->assertRedirect(route('login'));
    }

    /**
     * User can be disabled
     * 
     * @return void
     */
    public function test_user_can_be_disabled(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin'
        ]);

        $user = User::factory()->create();

        $response = $this->actingAs($admin)
            ->put(route('admin.users.update', $user), [
                'disable_at' => now(),
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role
            ]);

        $response->assertRedirect(route('admin.users'));
    }

    /**
     * User can be enabled
     * 
     * @return void
     */
    public function test_user_can_be_enabled(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin'
        ]);

        $user = User::factory()->create([
            'disable_at' => now(),
        ]);

        $response = $this->actingAs($admin)
            ->put(route('admin.users.update', $user), [
                'disable_at' => null,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role
            ]);

        $response->assertRedirect(route('admin.users'));
    }
}
