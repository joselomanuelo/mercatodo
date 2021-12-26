<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ListUsersTest extends TestCase
{
    use RefreshDatabase;
    /**
     * List of users can be rendered
     *
     * @return void
     */
    public function test_users_list_screen_can_be_rendered(): void
    {
        $user = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($user)
                    ->get(route('admin.users'));

        $this->assertAuthenticated();

        $response->assertOk();
    }

    /**
     * Unauthenticated user can´t render user's list screen
     * 
     * @return void
     */
    public function test_unauthenticated_user_cant_render_users_list_screen(): void
    {
        $response = $this->get(route('admin.users'));

        $response->assertRedirect(route('login'));
    }

    /**
     * Unauthenticated user can´t render user's list screen
     * 
     * @return void
     */
    public function test_not_admin_user_cant_render_users_list_screen(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                    ->get(route('admin.users'));
        
        $this->assertAuthenticated();

        $response->assertForbidden();
    }
}
