<?php

namespace tests\Feature\Buyer\Products;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexProductsTest extends TestCase
{
    use RefreshDatabase;

    public function testProductsListScreenCanBeRendered(): void
    {
        $response = $this->get(route('buyer.products.index'));

        // assertions
        $this->assertGuest();

        $response->assertViewIs('buyer.products.index');

        $response->assertOk();
    }
}
