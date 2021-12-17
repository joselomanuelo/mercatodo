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
     * Admin can delete a user
     *
     * @return void
     */
    public function test_admin_can_delete_user()
    {
        $user = User::factory()->create();

        $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();

        $user = User::factory()->create();

        $response = $this->delete('/admin/users/' . $user->id);

        $this->assertDeleted($user);

        $response->assertRedirect('/admin/users');
    }
}
