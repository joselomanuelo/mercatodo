<?php

namespace Tests\Feature\Auth;

use App\Constants\RouteNames;
use App\Events\UserLogedEvent;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class AuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function testLoginScreenCanBeRendered(): void
    {
        $response = $this->get(route(RouteNames::LOGIN));

        $response->assertStatus(200);
    }

    public function testUsersCanAuthenticateUsingTheLoginScreen(): void
    {
        Event::fake();

        $user = User::factory()->create();

        $response = $this->post(route(RouteNames::LOGIN_ATTEMP), [
            'email' => $user->email,
            'password' => 'password',
        ]);

        $this->assertAuthenticated();
        $response->assertRedirect(RouteServiceProvider::HOME);

        Event::assertDispatched(UserLogedEvent::class);
    }

    public function testUsersCanNotAuthenticateWithInvalidPassword(): void
    {
        $user = User::factory()->create();

        $this->post(route(RouteNames::LOGIN_ATTEMP), [
            'email' => $user->email,
            'password' => 'wrong-password',
        ]);

        $this->assertGuest();
    }
}
