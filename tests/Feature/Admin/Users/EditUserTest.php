<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Edit user screen can be rendered 
     *
     * @return void
     */
    public function test_edit_user_screen_can_be_rendered(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin'
        ]);

        $response = $this->actingAs($admin)->get(route('admin.users.edit', $admin));


        // assertions
        $this->assertAuthenticated();

        $this->assertDatabaseCount('users', 1);

        $response->assertViewIs('admin.edit');

        $response->assertOk();
    }

    /**
     * Not admin user cant render edit user screen 
     *
     * @return void
     */
    public function test_not_admin_user_cant_render_edit_user_screen(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.users.edit', $user));


        // assertions
        $this->assertAuthenticated();

        $this->assertDatabaseCount('users', 1);

        $response->assertForbidden();
    }

    /**
     * An user can be edited 
     *
     * @return void
     */
    public function test_user_can_be_edited(): void
    {
        $userToEdit = User::factory()->create();

        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)
            ->put(route('admin.users.update', $userToEdit), [
                'name' => 'Testing name',
                'email' => 'testingemail@example.com',
                'disable_at' => null,
                'role' => 'buyer'
            ]);

        $editedUser = User::find($userToEdit->id);


        // assertions
        $this->assertAuthenticated();

        $this->assertDatabaseCount('users', 2);

        $this->assertEquals('Testing name', $editedUser->name);

        $this->assertEquals('testingemail@example.com', $editedUser->email);

        $response->assertRedirect(route('admin.users'));
    }

    /**
     * Not admin user cant edit users 
     *
     * @return void
     */
    public function test_not_admin_user_cant_edit_users(): void
    {
        $userToEdit = User::factory()->create();

        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->put(route('admin.users.update', $userToEdit), [
                'name' => 'Testing name',
                'email' => 'testingemail@example.com',
                'status' => true,
            ]);


        // assertions
        $this->assertAuthenticated();

        $this->assertDatabaseCount('users', 2);

        $response->assertForbidden();
    }
}
