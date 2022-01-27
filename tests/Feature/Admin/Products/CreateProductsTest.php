<?php

namespace tests\Feature\Admin\Products;

use App\Constants\Permissions;
use App\Constants\Roles;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class CreateProductsTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateProductScreenCanBeRendered(): void
    {
        $createProductsPermission = Permission::create([
            'name' => Permissions::CREATE_PRODUCTS,
        ]);

        $adminRole = Role::create(['name' => Roles::ADMIN])
            ->givePermissionTo($createProductsPermission);

        $admin = User::factory()
            ->create()
            ->assignRole($adminRole);

        $response = $this->actingAs($admin)
            ->get(Product::createRoute());

        // assertions
        $response->assertOk();
        $response->assertViewIs(Product::createView());
        $this->assertAuthenticated();
        $this->assertDatabaseCount('products', 0);
    }

    public function testNotAdminUserCantRenderCreateProductScreen(): void
    {
        $buyerRole = Role::create(['name' => Roles::BUYER]);

        $buyer = User::factory()
            ->create()
            ->assignRole($buyerRole);

        $response = $this->actingAs($buyer)
            ->get(Product::createRoute());

        // assertions
        $response->assertForbidden();
        $this->assertAuthenticated();
        $this->assertDatabaseCount('products', 0);
    }

    public function testProductCanBeCreated(): void
    {
        $createProductsPermission = Permission::create([
            'name' => Permissions::CREATE_PRODUCTS,
        ]);

        $adminRole = Role::create(['name' => Roles::ADMIN])
            ->givePermissionTo($createProductsPermission);

        $admin = User::factory()
            ->create()
            ->assignRole($adminRole);

        $category = Category::factory()->create();

        $response = $this->actingAs($admin)
            ->post(Product::storeRoute(), [
                'name' => 'Testing product',
                'description' => 'Testing description',
                'price' => 100,
                'stock' => 100,
                'category' => $category->id,
            ]);

        $product = Product::first();

        // assertions
        $response->assertRedirect(Product::indexRoute());
        $this->assertAuthenticated();
        $this->assertDatabaseCount('products', 1);
        $this->assertEquals('Testing product', $product->name);
        $this->assertEquals('Testing description', $product->description);
        $this->assertEquals(10000, $product->price);
        $this->assertEquals($category->id, $product->category->id);
        $this->assertEquals(100, $product->stock);
    }

    public function testNotAdminUserCantCreateProducts(): void
    {
        $buyerRole = Role::create(['name' => Roles::BUYER]);

        $buyer = User::factory()
            ->create()
            ->assignRole($buyerRole);

        $category = Category::factory()->create();

        $response = $this->actingAs($buyer)
            ->post(Product::storeRoute(), [
                'name' => 'Testing product',
                'description' => 'Testing description',
                'price' => 100,
                'stock' => 100,
                'category' => $category->id,
            ]);

        // assertions
        $response->assertForbidden();
        $this->assertAuthenticated();
        $this->assertDatabaseCount('products', 0);
    }
}
