<?php

namespace Tests\Feature\Api\Orders;

use App\Constants\RouteNames;
use Tests\TestCase;

class CreateOrdersTest extends TestCase
{
    public function testOrderCanBeCreated(): void
    {
        $order = '{"price":8124798,"quantities":{"3":{"amount":33,"price":98293},"12":{"amount":59,"price":82731}}}';
        //dd(json_decode($order, true));
        $response = $this->post(route(RouteNames::API_STORE_ORDERS), ['order' => $order]);

        $response->assertStatus(200);
    }
}
