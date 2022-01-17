<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ToggleUserTest extends TestCase
{
    use RefreshDatabase;

    public function testDisabledUserCantDoAnything(): void
    {
        $buyerRole = Role::create(['name' => 'buyer']);

        $user = User::factory()
            ->create(['disabled_at' => now()])
            ->assignRole($buyerRole);

        $response = $this->actingAs($user)
            ->get(route('welcome'));

        // assertions
        $this->assertGuest();

        $this->assertDatabaseCount('users', 1);

        $response->assertRedirect(route('login'));
    }

    public function testUserCanBeDisabled(): void
    {
        $editUsersPermission = Permission::create(['name' => 'update users']);

        $adminRole = Role::create(['name' => 'admin'])
            ->givePermissionTo($editUsersPermission);

        $admin = User::factory()
            ->create()
            ->assignRole($adminRole);

        $user = User::factory()
            ->create();

        $response = $this->actingAs($admin)
            ->put(route('admin.users.toggle', $user));

        // assertions
        $this->assertAuthenticated();

        $this->assertDatabaseCount('users', 2);

        $response->assertRedirect(route('admin.users.index'));
    }

    public function testUserCanBeEnabled(): void
    {
        $editUsersPermission = Permission::create(['name' => 'update users']);

        $adminRole = Role::create(['name' => 'admin'])
            ->givePermissionTo($editUsersPermission);

        $admin = User::factory()
            ->create()
            ->assignRole($adminRole);

        $user = User::factory()
            ->create([
                'disabled_at' => now(),
            ]);

        $response = $this->actingAs($admin)
            ->put(route('admin.users.toggle', $user));

        // assertions
        $this->assertAuthenticated();

        $this->assertDatabaseCount('users', 2);

        $response->assertRedirect(route('admin.users.index'));
    }
}
