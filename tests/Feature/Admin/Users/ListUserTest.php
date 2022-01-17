<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ListUsersTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function testUsersListScreenCanBeRendered(): void
    {
        $indexUsersPermission = Permission::create(['name' => 'index users']);

        $adminRole = Role::create(['name' => 'admin'])
            ->givePermissionTo($indexUsersPermission);

        $admin = User::factory()
            ->create()
            ->assignRole($adminRole);

        $response = $this->actingAs($admin)
            ->get(route('admin.users.index'));

        // assertions
        $this->assertAuthenticated();

        $this->assertDatabaseCount('users', 1);

        $response->assertViewIs('admin.users.index');

        $response->assertOk();
    }

    public function testUnauthenticatedUserCantRenderUsersListScreen(): void
    {
        $response = $this->get(route('admin.users.index'));

        // assertions
        $this->assertGuest();

        $this->assertDatabaseCount('users', 0);

        $response->assertRedirect(route('login'));
    }

    public function testNotAdminUserCantRenderUsersListScreen(): void
    {
        $buyerRole = Role::create(['name' => 'buyer']);

        $user = User::factory()
            ->create()
            ->assignRole($buyerRole);

        $response = $this->actingAs($user)
            ->get(route('admin.users.index'));

        // assertions
        $this->assertAuthenticated();

        $this->assertDatabaseCount('users', 1);

        $response->assertForbidden();
    }
}
