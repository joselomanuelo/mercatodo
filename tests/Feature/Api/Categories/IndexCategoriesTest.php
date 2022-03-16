<?php

namespace Tests\Feature\Api\Categories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class IndexCategoriesTest extends TestCase
{
    use RefreshDatabase;

    public function testCategoriesCanBeIndex(): void
    {
        $user = User::factory()->create();

        Category::factory()
            ->count(10)
            ->create();

        $response = $this->actingAs($user, 'api')
            ->getJson(Category::ApiIndexRoute());

        $response->assertOk();

        $this->assertAuthenticated();
        $this->assertCount(10, $response->json()['data']);
    }
}
