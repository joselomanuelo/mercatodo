<?php

namespace Tests\Feature\Api\Orders;

use Tests\TestCase;

class IndexOrdersTest extends TestCase
{
    public function testExample()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
