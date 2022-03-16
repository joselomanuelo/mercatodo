<?php

namespace tests\Feature\Buyer\Products;

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexProductsTest extends TestCase
{
    use RefreshDatabase;

    public function testProductsListScreenCanBeRendered(): void
    {
        $response = $this->get(Product::buyerIndexRoute());

        // assertions
        $this->assertGuest();

        $response->assertOk();

        $response->assertViewIs(Product::buyerIndexView());
    }
}
