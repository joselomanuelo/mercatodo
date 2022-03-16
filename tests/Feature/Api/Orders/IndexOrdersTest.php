<?php

namespace Tests\Feature\Api\Orders;

use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexOrdersTest extends TestCase
{
    use RefreshDatabase;

    public function testOrdersCanBeIndex(): void
    {
        $user = User::factory()->create();

        Order::factory()
            ->count(10)
            ->for($user)
            ->create();

        $response = $this->actingAs($user, 'api')
            ->getJson(Order::ApiIndexRoute());

        $response->assertOk();

        $this->assertAuthenticated();
        $this->assertCount(10, $response->json()['data']);
    }
}
