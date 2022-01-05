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
    public function test_disabled_user_cant_do_anything(): void
    {
        $user = User::factory()->create([
            'disabled_at' => now(),
        ]);

        $response = $this->actingAs($user)
            ->get(route('welcome'));


        // assertions
        $this->assertGuest();

        $this->assertDatabaseCount('users', 1);

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
                'disabled_at' => now(),
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role
            ]);


        // assertions
        $this->assertAuthenticated();

        $this->assertDatabaseCount('users', 2);

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
            'disabled_at' => now(),
        ]);

        $response = $this->actingAs($admin)
            ->put(route('admin.users.update', $user), [
                'disabled_at' => null,
                'name' => $user->name,
                'email' => $user->email,
                'role' => $user->role
            ]);


        // assertions
        $this->assertAuthenticated();

        $this->assertDatabaseCount('users', 2);

        $response->assertRedirect(route('admin.users'));
    }
}
