<?php

namespace tests\Feature\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ShowProductsTest extends TestCase
{
    use RefreshDatabase;

    public function testShowProductScreenCanBeRendered(): void
    {
        $showProductsPermission = Permission::create(['name' => 'show products']);

        $adminRole = Role::create(['name' => 'admin'])
            ->givePermissionTo($showProductsPermission);

        $admin = User::factory()
            ->create()
            ->assignRole($adminRole);

        $product = Product::factory()
            ->for(Category::factory()->create())
            ->create();

        $response = $this->actingAs($admin)
            ->get(route('admin.products.show', $product));

        // assertions
        $this->assertAuthenticated();

        $response->assertOk();

        $this->assertDatabaseCount('products', 1);

        $response->assertViewIs('admin.products.show');

        
    }

    public function testNotAdminUserCantSeeProducts(): void
    {
        $buyerRole = Role::create(['name' => 'buyer']);

        $user = User::factory()
            ->create()
            ->assignRole($buyerRole);

        $product = Product::factory()
            ->for(Category::factory()->create())
            ->create();

        $response = $this->actingAs($user)
            ->get(route('admin.products.show', $product));

        // assertions
        $this->assertAuthenticated();

        $response->assertForbidden();

        $this->assertDatabaseCount('products', 1);

        
    }
}
