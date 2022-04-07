<?php

namespace Tests\Feature\Admin\Users;

use App\Constants\Permissions;
use App\Constants\Roles;
use App\Events\UserUpdatedEvent;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class EditUserTest extends TestCase
{
    use RefreshDatabase;

    public function testEditUserScreenCanBeRendered(): void
    {
        $editUsersPermission = Permission::create(['name' => Permissions::UPDATE_USERS]);

        $adminRole = Role::create(['name' => Roles::ADMIN])
            ->givePermissionTo($editUsersPermission);

        $admin = User::factory()
            ->create()
            ->assignRole($adminRole);

        $response = $this->actingAs($admin)
            ->get($admin->editRoute());

        // assertions
        $response->assertOk();
        $response->assertViewIs(User::editView());
        $this->assertAuthenticated();
        $this->assertDatabaseCount('users', 1);
    }

    public function testNotAdminUserCantRenderEditUserScreen(): void
    {
        $buyerRole = Role::create(['name' => Roles::BUYER]);

        $user = User::factory()
            ->create()
            ->assignRole($buyerRole);

        $response = $this->actingAs($user)
            ->get($user->editRoute());

        // assertions
        $response->assertForbidden();
        $this->assertAuthenticated();
        $this->assertDatabaseCount('users', 1);
    }

    public function testUserCanBeEdited(): void
    {
        Event::fake();

        $editUsersPermission = Permission::create(['name' => Permissions::UPDATE_USERS]);

        Role::create(['name' => 'buyer']);

        $adminRole = Role::create(['name' => Roles::ADMIN])
            ->givePermissionTo($editUsersPermission);

        $admin = User::factory()
            ->create()
            ->assignRole($adminRole);

        $userToEdit = User::factory()
            ->create();

        $response = $this->actingAs($admin)
            ->put($userToEdit->updateRoute(), [
                'name' => 'Testing name',
                'email' => 'testingemail@example.com',
                'disable_at' => null,
            ]);

        $editedUser = User::find($userToEdit->id);

        // assertions
        $response->assertRedirect(User::indexRoute());
        $this->assertAuthenticated();
        $this->assertDatabaseCount('users', 2);
        $this->assertEquals('Testing name', $editedUser->name);
        $this->assertEquals('testingemail@example.com', $editedUser->email);

        Event::assertDispatched(UserUpdatedEvent::class);
    }

    public function testNotAdminUserCantEditUsers(): void
    {
        $buyerRole = Role::create(['name' => Roles::BUYER]);

        $buyer = User::factory()
            ->create()
            ->assignRole($buyerRole);

        $userToEdit = User::factory()->create();

        $response = $this->actingAs($buyer)
            ->put($userToEdit->updateRoute(), [
                'name' => 'Testing name',
                'email' => 'testingemail@example.com',
            ]);

        // assertions
        $response->assertForbidden();
        $this->assertAuthenticated();
        $this->assertDatabaseCount('users', 2);
    }
}
