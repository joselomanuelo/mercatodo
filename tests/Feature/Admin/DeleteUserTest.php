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
    public function test_user_can_be_delete()
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('login'));

        /*$this->post(route('login'), [
            'email' => $user->email,
            'password' => 'password',
        ]);*/

        $this->assertAuthenticated();

        $user = User::factory()->create();

        $response = $this->delete(route('admin.users.destroy', $user));

        $this->assertDeleted($user);

        $response->assertRedirect(route('admin.users'));
    }
}
