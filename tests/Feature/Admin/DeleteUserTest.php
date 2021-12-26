<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * An user can be deleted 
     *
     * @return void
     */
    public function test_user_can_be_delete(): void
    {
        $user = User::factory()->create([
            'role' => 'admin',
        ]);

        $userToDelete = User::factory()->create();

        $response = $this->actingAs($user)
                    ->delete(route('admin.users.destroy', $userToDelete));

        $this->assertDeleted($userToDelete);

        $response->assertRedirect(route('admin.users'));
    }

    /**
     * Not admin user cant delete users
     *
     * @return void
     */
    public function test_not_admin_user_cant_delete_users(): void
    {
        $user = User::factory()->create();

        $userToDelete = User::factory()->create();

        $response = $this->actingAs($user)
                    ->delete(route('admin.users.destroy', $userToDelete));

        $response->assertForbidden();
    }
}
