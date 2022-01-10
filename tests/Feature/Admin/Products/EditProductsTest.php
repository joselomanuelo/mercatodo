<?php

namespace tests\Feature\Admin;

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
        $editProductsPermission = Permission::create(['name' => 'update products']);

        $adminRole = Role::create(['name' => 'admin'])
            ->givePermissionTo($editProductsPermission);

        $admin = User::factory()
            ->create()
            ->assignRole($adminRole);

        $product = Product::factory()
            ->for(Category::factory()->create())
            ->create();

        $response = $this->actingAs($admin)
            ->get(route('admin.products.edit', $product));

        // assertions
        $this->assertAuthenticated();

        $this->assertDatabaseCount('products', 1);

        $response->assertViewIs('admin.products.edit');

        $response->assertOk();
    }

    public function testNotAdminUserCantRenderEditProductScreen(): void
    {
        $buyerRole = Role::create(['name' => 'buyer']);

        $user = User::factory()
            ->create()
            ->assignRole($buyerRole);

        $product = Product::factory()
            ->for(Category::factory()->create())
            ->create();

        $response = $this->actingAs($user)
            ->get(route('admin.products.edit', $product));

        // assertions
        $this->assertAuthenticated();

        $this->assertDatabaseCount('products', 1);

        $response->assertForbidden();
    }

    public function testUserCanBeEdited(): void
    {
        $editProductsPermission = Permission::create(['name' => 'update products']);

        $adminRole = Role::create(['name' => 'admin'])
            ->givePermissionTo($editProductsPermission);

        $admin = User::factory()
            ->create()
            ->assignRole($adminRole);

        $productToEdit = Product::factory()
            ->for(Category::factory()->create())
            ->create();

        $response = $this->actingAs($admin)
            ->put(route('admin.products.update', $productToEdit), [
                'product' => 'Testing product',
                'description' => 'Testing description',
                'price' => 100.99,
                'category_id' => 1,
                'stock' => 100,
            ]);

        $editedProduct = Product::find($productToEdit->id);

        // assertions
        $this->assertAuthenticated();

        $this->assertDatabaseCount('products', 1);

        $this->assertEquals('Testing product', $editedProduct->product);
        $this->assertEquals('Testing description', $editedProduct->description);
        $this->assertEquals(100.99, $editedProduct->price);
        $this->assertEquals(1, $editedProduct->category_id);
        $this->assertEquals(100, $editedProduct->stock);

        $response->assertRedirect(route('admin.products.index'));
    }

    public function testNotAdminUserCantEditProducts(): void
    {
        $buyerRole = Role::create(['name' => 'buyer']);

        $user = User::factory()
            ->create()
            ->assignRole($buyerRole);

        $productToEdit = Product::factory()
            ->for(Category::factory()->create())
            ->create();

        $response = $this->actingAs($user)
        ->put(route('admin.products.update', $productToEdit), [
            'product' => 'Testing product',
            'description' => 'Testing description',
            'price' => 100.99,
            'category_id' => 1,
            'stock' => 100,
        ]);

        // assertions
        $this->assertAuthenticated();

        $this->assertDatabaseCount('products', 1);

        $response->assertForbidden();
    }
}
