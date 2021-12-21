<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EditUserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Edit user screen can be rendered 
     *
     * @return void
     */
    public function test_edit_user_screen_can_be_rendered()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.users.edit', $user));

        $response->assertOk();
    }

    use RefreshDatabase;

    /**
     * An user can be edited 
     *
     * @return void
     */
    public function test_user_can_be_edited()
    {
       

        $userToEdit = User::factory()->create();
        
        $user = User::factory()->create();

        $response = $this->actingAs($user)
                    ->put(route('admin.users.update', $userToEdit), [
                        'name' => 'Testing name',
                        'email' => 'testingemail@example.com'
                    ]);
        
        $editedUser = User::find($userToEdit->id);

        $this->assertEquals('Testing name', $editedUser->name);
        
        $this->assertEquals('testingemail@example.com', $editedUser->email);

        $response->assertRedirect(route('admin.users'));
    }
}
