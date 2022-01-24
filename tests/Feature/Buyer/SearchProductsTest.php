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
            'category' => '1',
            'priceFrom' => '10',
            'priceTo' => '10000',
        ]);

        // assertions
        $this->assertGuest();

        $response->assertOk();

        $response->assertViewIs('buyer.products.index');

        
    }
}
