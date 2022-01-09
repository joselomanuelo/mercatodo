<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ShowUserTest extends TestCase
{
    use RefreshDatabase;

    public function testShowUserScreenCanBeRendered(): void
    {
        $showUsersPermission = Permission::create(['name' => 'show users']);

        $adminRole = Role::create(['name' => 'admin'])
            ->givePermissionTo($showUsersPermission);

        $admin = User::factory()
            ->create()
            ->assignRole($adminRole);

        $response = $this->actingAs($admin)
            ->get(route('admin.users.show', $admin));

        // assertions
        $this->assertAuthenticated();

        $this->assertDatabaseCount('users', 1);

        $response->assertViewIs('admin.users.show');

        $response->assertOk();
    }

    public function testNotAdminUserCantSeeUsers(): void
    {
        $buyerRole = Role::create(['name' => 'buyer']);

        $user = User::factory()
            ->create()
            ->assignRole($buyerRole);

        $response = $this->actingAs($user)
            ->get(route('admin.users.show', $user));

        // assertions
        $this->assertAuthenticated();

        $this->assertDatabaseCount('users', 1);

        $response->assertForbidden();
    }
}
