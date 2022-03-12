<?php

namespace Tests\Feature\Api\Orders;

use App\Events\OrderCreated;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class CreateOrdersTest extends TestCase
{
    use RefreshDatabase;

    public function testOrderCanBeCreated(): string
    {
        Event::fake();

        Product::factory()->create([
            'id' => 1,
            'name' => 'Product A',
            'price' => 10000,
        ]);

        Product::factory()->create([
            'id' => 2,
            'name' => 'Product B',
            'price' => 20000,
        ]);

        $user = User::factory()
            ->create([
            'id' => 1,
        ]);

        $price = '90000';

        $order = '[{"product_id":1,"name":"Product A","amount":"5","price":50000},{"product_id":2,"name":"Product B","amount":"2","price":40000}]';

        $response = $this->actingAs($user, 'api')
            ->postJson(Order::ApiStoreRoute(), compact('order', 'price'));

        $response->assertCreated();

        $this->assertAuthenticated();
        $this->assertDatabaseCount('orders', 1);
        $this->assertDatabaseCount('order_products', 2);
        $this->assertTrue(!is_null($response->json()['data']['process_url']));
        $this->assertTrue(!is_null($response->json()['data']['request_id']));

        $response
            ->assertJson(
                fn (AssertableJson $json) => $json->has('data')
                    ->has('data.process_url')
                    ->has('data.request_id')
                    ->etc()
            );

        Event::assertDispatched(OrderCreated::class);

        $request_id = $response->json()['data']['request_id'];

        return $request_id;
    }

    /**
     * @depends testOrderCanBeCreated
     */
    public function testOrderCanBeConsulted(string $request_id): void
    {
        $user = User::factory()
            ->create([
            'id' => 1,
        ]);

        $order = Order::factory()->create([
            'request_id' => $request_id,
        ]);

        $response = $this->actingAs($user, 'api')
        ->getJson($order->apiShowRoute());

        $response->assertOk();

        $this->assertAuthenticated();
    }

    /**
     * @depends testOrderCanBeCreated
     */
    public function testOrderCanBeRetried(string $request_id): void
    {
        $user = User::factory()
            ->create([
            'id' => 1,
        ]);

        $order = Order::factory()->create([
            'request_id' => $request_id,
        ]);

        $response = $this->actingAs($user, 'api')
            ->postJson(Order::ApiStoreRoute(), [
                'order_id' => $order->id,
            ]);

        $response->assertCreated();

        $this->assertAuthenticated();
    }
}
