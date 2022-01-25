<?php

namespace Tests\Feature\Admin\Users;

use App\Constants\Permissions;
use App\Constants\Roles;
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
        $buyerRole = Role::create(['name' => Roles::BUYER]);

        $user = User::factory()
            ->create(['disabled_at' => now()])
            ->assignRole($buyerRole);

        $response = $this->actingAs($user)
            ->get(route('welcome'));

        // assertions
        $response->assertRedirect(route('login'));
        $this->assertGuest();
        $this->assertDatabaseCount('users', 1);
    }

    public function testUserCanBeDisabled(): void
    {
        $editUsersPermission = Permission::create(['name' => Permissions::UPDATE_USERS]);

        $adminRole = Role::create(['name' => Roles::ADMIN])
            ->givePermissionTo($editUsersPermission);

        $admin = User::factory()
            ->create()
            ->assignRole($adminRole);

        $user = User::factory()
            ->create();

        $response = $this->actingAs($admin)
            ->put($user->toggleRoute());

        // assertions
        $response->assertRedirect(User::indexRoute());
        $this->assertAuthenticated();
        $this->assertDatabaseCount('users', 2);
    }

    public function testUserCanBeEnabled(): void
    {
        $editUsersPermission = Permission::create(['name' => Permissions::UPDATE_USERS]);

        $adminRole = Role::create(['name' => Roles::ADMIN])
            ->givePermissionTo($editUsersPermission);

        $admin = User::factory()
            ->create()
            ->assignRole($adminRole);

        $user = User::factory()
            ->create([
                'disabled_at' => now(),
            ]);

        $response = $this->actingAs($admin)
            ->put($user->toggleRoute());

        // assertions
        $response->assertRedirect(User::indexRoute());
        $this->assertAuthenticated();
        $this->assertDatabaseCount('users', 2);
    }
}
