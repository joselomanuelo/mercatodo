<?php

namespace Tests\Feature\Admin\Users;

use App\Constants\Permissions;
use App\Constants\Roles;
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
        $showUsersPermission = Permission::create(['name' => Permissions::SHOW_USERS]);

        $adminRole = Role::create(['name' => Roles::ADMIN])
            ->givePermissionTo($showUsersPermission);

        $admin = User::factory()
            ->create()
            ->assignRole($adminRole);

        $response = $this->actingAs($admin)
            ->get($admin->showRoute());

        // assertions
        $response->assertOk();
        $response->assertViewIs(User::showView());
        $this->assertAuthenticated();
        $this->assertDatabaseCount('users', 1);
    }

    public function testNotAdminUserCantSeeUsers(): void
    {
        $buyerRole = Role::create(['name' => Roles::BUYER]);

        $buyer = User::factory()
            ->create()
            ->assignRole($buyerRole);

        $response = $this->actingAs($buyer)
            ->get($buyer->showRoute());

        // assertions
        $response->assertForbidden();
        $this->assertAuthenticated();
        $this->assertDatabaseCount('users', 1);
    }
}
