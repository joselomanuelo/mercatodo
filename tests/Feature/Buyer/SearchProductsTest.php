<?php

namespace tests\Feature\Buyer\Products;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SearchProductsTest extends TestCase
{
    use RefreshDatabase;

    public function testProductsSearchScreenCanBeRendered(): void
    {
        $response = $this->get(route('buyer.products.index'), [
            'search' => 'search',
        ]);

        // assertions
        $this->assertGuest();

        $response->assertViewIs('buyer.products.index');

        $response->assertOk();
    }
}
