<?php

namespace Tests\Feature\Api\Products;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexProductsTest extends TestCase
{
    use RefreshDatabase;

    public function testProductsCanBeIndex(): void
    {
        $user = User::factory()->create();

        Product::factory()
            ->count(10)
            ->create();

        $response = $this->actingAs($user, 'api')
            ->getJson(Product::ApiIndexRoute());

        $response->assertOk();

        $this->assertAuthenticated();
        $this->assertCount(10, $response->json()['data']);
    }
}
