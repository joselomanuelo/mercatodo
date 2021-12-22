<?php

namespace Tests\Feature\Admin;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ToggleUserTest extends TestCase
{
    use RefreshDatabase;
    
    /**
     * Disable user can't do anything 
     *
     * @return void
     */
    public function test_disable_user_cant_do_anything()
    {
        $user = User::factory()->create([
            'status' => false,
        ]);

        $response = $this->actingAs($user)
                    ->get('/');
              
        $this->assertGuest();

        $response->assertRedirect(route('login'));
    }
}
