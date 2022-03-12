<?php

namespace Tests\Feature\Admin\Users;

use App\Constants\Permissions;
use App\Constants\Roles;
use App\Events\UserDeleted;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class DeleteUserTest extends TestCase
{
    use RefreshDatabase;

    public function testUserCanBeDelete(): void
    {
        Event::fake();

        $deleteUsersPermission = Permission::create(['name' => Permissions::DELETE_USERS]);

        $adminRole = Role::create(['name' => Roles::ADMIN])
            ->givePermissionTo($deleteUsersPermission);

        $admin = User::factory()
            ->create()
            ->assignRole($adminRole);

        $userToDelete = User::factory()
            ->create();

        $response = $this->actingAs($admin)
            ->delete($userToDelete->destroyRoute());

        // assertions
        $response->assertRedirect($admin->indexRoute());
        $this->assertAuthenticated();
        $this->assertDatabaseCount('users', 1);
        $this->assertDeleted($userToDelete);

        Event::assertDispatched(UserDeleted::class);
    }

    public function testNotAdminUserCantDeleteUsers(): void
    {
        $buyerRole = Role::create(['name' => Roles::BUYER]);

        $user = User::factory()
            ->create()
            ->assignRole($buyerRole);

        $userToDelete = User::factory()
            ->create();

        $response = $this->actingAs($user)
            ->delete($userToDelete->destroyRoute());

        // assertions
        $response->assertForbidden();
        $this->assertAuthenticated();
        $this->assertDatabaseCount('users', 2);
        $this->assertModelExists($userToDelete);
    }
}
