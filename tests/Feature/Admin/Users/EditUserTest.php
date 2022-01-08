<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class EditUserTest extends TestCase
{
    use RefreshDatabase;

    public function testEditUserScreenCanBeRendered(): void
    {
        $editUsersPermission = Permission::create(['name' => 'update users']);

        $adminRole = Role::create(['name' => 'admin'])
            ->givePermissionTo($editUsersPermission);

        $admin = User::factory()
            ->create()
            ->assignRole($adminRole);

        $response = $this->actingAs($admin)
            ->get(route('admin.users.edit', $admin));

        // assertions
        $this->assertAuthenticated();

        $this->assertDatabaseCount('users', 1);

        $response->assertViewIs('admin.edit');

        $response->assertOk();
    }

    public function testNotAdminUserCantRenderEditUserScreen(): void
    {
        $buyerRole = Role::create(['name' => 'buyer']);

        $user = User::factory()
            ->create()
            ->assignRole($buyerRole);

        $response = $this->actingAs($user)
            ->get(route('admin.users.edit', $user));

        // assertions
        $this->assertAuthenticated();

        $this->assertDatabaseCount('users', 1);

        $response->assertForbidden();
    }

    public function testUserCanBeEdited(): void
    {
        $editUsersPermission = Permission::create(['name' => 'update users']);

        $adminRole = Role::create(['name' => 'admin'])
            ->givePermissionTo($editUsersPermission);

        $admin = User::factory()
            ->create()
            ->assignRole($adminRole);

        $userToEdit = User::factory()
            ->create();

        $response = $this->actingAs($admin)
            ->put(route('admin.users.update', $userToEdit), [
                'name' => 'Testing name',
                'email' => 'testingemail@example.com',
                'disable_at' => null,
            ]);

        $editedUser = User::find($userToEdit->id);

        // assertions
        $this->assertAuthenticated();

        $this->assertDatabaseCount('users', 2);

        $this->assertEquals('Testing name', $editedUser->name);

        $this->assertEquals('testingemail@example.com', $editedUser->email);

        $response->assertRedirect(route('admin.users'));
    }

    public function testNotAdminUserCantEditUsers(): void
    {
        $buyerRole = Role::create(['name' => 'buyer']);

        $user = User::factory()
            ->create()
            ->assignRole($buyerRole);

        $userToEdit = User::factory()->create();

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
