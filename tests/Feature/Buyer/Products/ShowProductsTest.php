<?php

namespace tests\Feature\Buyer\Products;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ShowProductsTest extends TestCase
{
    use RefreshDatabase;

    public function testShowProductScreenCanBeRendered(): void
    {
        $product = Product::factory()
            ->for(Category::factory()->create())
            ->create();

        $response = $this->get($product->buyerShowRoute());

        // assertions
        $this->assertGuest();

        $this->assertDatabaseCount('products', 1);

        $response->assertViewIs(Product::buyerShowView());

        $response->assertOk();
    }
}
