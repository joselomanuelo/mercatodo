<?php

namespace Tests\Feature\Admin\Users;

use App\Constants\Permissions;
use App\Constants\Roles;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class IndexUsersTest extends TestCase
{
    use RefreshDatabase;

    public function testUsersListScreenCanBeRendered(): void
    {
        $indexUsersPermission = Permission::create(['name' => Permissions::INDEX_USERS]);

        $adminRole = Role::create(['name' => Roles::ADMIN])
            ->givePermissionTo($indexUsersPermission);

        $admin = User::factory()
            ->create()
            ->assignRole($adminRole);

        $response = $this->actingAs($admin)
            ->get(User::indexRoute());

        // assertions
        $response->assertOk();
        $response->assertViewIs(User::indexView());
        $this->assertAuthenticated();
        $this->assertDatabaseCount('users', 1);
    }

    public function testUnauthenticatedUserCantRenderUsersListScreen(): void
    {
        $response = $this->get(User::indexRoute());

        // assertions
        $response->assertRedirect(route('login'));
        $this->assertGuest();
        $this->assertDatabaseCount('users', 0);
    }

    public function testNotAdminUserCantRenderUsersListScreen(): void
    {
        $buyerRole = Role::create(['name' => Roles::BUYER]);

        $user = User::factory()
            ->create()
            ->assignRole($buyerRole);

        $response = $this->actingAs($user)
            ->get(User::indexRoute());

        // assertions
        $response->assertForbidden();
        $this->assertAuthenticated();
        $this->assertDatabaseCount('users', 1);
    }
}
