<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class DeleteUserTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanBeDelete(): void
    {
        $deleteUsersPermission = Permission::create(['name' => 'delete users']);

        $adminRole = Role::create(['name' => 'admin'])
            ->givePermissionTo($deleteUsersPermission);

        $admin = User::factory()
            ->create()
            ->assignRole($adminRole);

        $userToDelete = User::factory()
            ->create();

        $response = $this->actingAs($admin)
            ->delete(route('admin.users.destroy', $userToDelete));

        // assertions
        $this->assertAuthenticated();

        $this->assertDatabaseCount('users', 1);

        $this->assertDeleted($userToDelete);

        $response->assertRedirect(route('admin.users'));
    }

    public function testNotAdminUserCantDeleteUsers(): void
    {
        $buyerRole = Role::create(['name' => 'buyer']);

        $user = User::factory()
            ->create()
            ->assignRole($buyerRole);

        $userToDelete = User::factory()
            ->create();

        $response = $this->actingAs($user)
            ->delete(route('admin.users.destroy', $userToDelete));

        // assertions
        $this->assertAuthenticated();

        $this->assertDatabaseCount('users', 2);

        $this->assertModelExists($userToDelete);

        $response->assertForbidden();
    }
}
