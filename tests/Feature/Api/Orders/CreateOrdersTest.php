<?php

namespace Tests\Feature\Api\Orders;

use App\Constants\RouteNames;
use Tests\TestCase;

class CreateOrdersTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}

