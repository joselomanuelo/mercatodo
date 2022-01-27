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

class EditProductsTest extends TestCase
{
    use RefreshDatabase;

    public function testEditProductScreenCanBeRendered(): void
    {
        $editProductsPermission = Permission::create(['name' => Permissions::UPDATE_PRODUCTS]);

        $adminRole = Role::create(['name' => Roles::ADMIN])
            ->givePermissionTo($editProductsPermission);

        $admin = User::factory()
            ->create()
            ->assignRole($adminRole);

        $product = Product::factory()
            ->for(Category::factory()->create())
            ->create();

        $response = $this->actingAs($admin)
            ->get($product->editRoute());

        // assertions
        $response->assertOk();
        $response->assertViewIs(Product::editView());
        $this->assertAuthenticated();
        $this->assertDatabaseCount('products', 1);
    }

    public function testNotAdminUserCantRenderEditProductScreen(): void
    {
        $buyerRole = Role::create(['name' => Roles::BUYER]);

        $buyer = User::factory()
            ->create()
            ->assignRole($buyerRole);

        $product = Product::factory()
            ->for(Category::factory()->create())
            ->create();

        $response = $this->actingAs($buyer)
            ->get($product->editRoute());

        // assertions
        $response->assertForbidden();
        $this->assertAuthenticated();
        $this->assertDatabaseCount('products', 1);
    }

    public function testProductCanBeEdited(): void
    {
        $editProductsPermission = Permission::create(['name' => Permissions::UPDATE_PRODUCTS]);

        $adminRole = Role::create(['name' => Roles::ADMIN])
            ->givePermissionTo($editProductsPermission);

        $admin = User::factory()
            ->create()
            ->assignRole($adminRole);

        $category = Category::factory()->create();

        $product = Product::factory()
            ->for($category)
            ->create();

        $response = $this->actingAs($admin)
            ->put($product->updateRoute(), [
                'name' => 'Testing product',
                'description' => 'Testing description',
                'price' => 100,
                'stock' => 100,
                'category' => $category->id,
            ]);

        $product2 = Product::find($product->id);

        // assertions
        $response->assertRedirect(Product::indexRoute());
        $this->assertAuthenticated();
        $this->assertDatabaseCount('products', 1);
        $this->assertEquals('Testing product', $product2->name);
        $this->assertEquals('Testing description', $product2->description);
        $this->assertEquals(10000, $product2->price);
        $this->assertEquals($category->id, $product2->category->id);
        $this->assertEquals(100, $product2->stock);
    }

    public function testNotAdminUserCantEditProducts(): void
    {
        $buyerRole = Role::create(['name' => Roles::BUYER]);

        $buyer = User::factory()
            ->create()
            ->assignRole($buyerRole);

        $productToEdit = Product::factory()
            ->for(Category::factory()->create())
            ->create();

        $response = $this->actingAs($buyer)
            ->put($productToEdit->updateRoute(), [
                'name' => 'Testing product',
                'description' => 'Testing description',
                'price' => 100,
                'category' => 1,
                'stock' => 100,
                'product_image' => null,
            ]);

        // assertions
        $response->assertForbidden();
        $this->assertAuthenticated();
        $this->assertDatabaseCount('products', 1);
    }
}
