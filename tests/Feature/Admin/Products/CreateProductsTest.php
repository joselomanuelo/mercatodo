<?php

namespace tests\Feature\Admin;

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
            ->get(route('admin.products.create'));

        // assertions
        $this->assertAuthenticated();

        $this->assertDatabaseCount('products', 0);

        $response->assertViewIs('admin.products.create');

        $response->assertOk();
    }

    public function testNotAdminUserCantRenderCreateProductScreen(): void
    {
        $buyerRole = Role::create(['name' => Roles::BUYER]);

        $user = User::factory()
            ->create()
            ->assignRole($buyerRole);

        $response = $this->actingAs($user)
            ->get(route('admin.products.create'));

        // assertions
        $this->assertAuthenticated();

        $this->assertDatabaseCount('products', 0);

        $response->assertForbidden();
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
            ->post(route('admin.products.store', [
                'name' => 'Testing product',
                'description' => 'Testing description',
                'price' => 100,
                'stock' => 100,
                'category' => $category->id,
            ]));

        $product = Product::first();

        // assertions
        $this->assertAuthenticated();

        $this->assertDatabaseCount('products', 1);

        $this->assertEquals('Testing product', $product->name);
        $this->assertEquals('Testing description', $product->description);
        $this->assertEquals(100, $product->price);
        $this->assertEquals($category->id, $product->category->id);
        $this->assertEquals(100, $product->stock);

        $response->assertRedirect(route('admin.products.index'));
    }

    public function testNotAdminUserCantCreateProducts(): void
    {
        $buyerRole = Role::create(['name' => Roles::BUYER]);

        $user = User::factory()
            ->create()
            ->assignRole($buyerRole);

        $category = Category::factory()->create();

        $response = $this->actingAs($user)
            ->post(route('admin.products.store', [
                'name' => 'Testing product',
                'description' => 'Testing description',
                'price' => 100,
                'stock' => 100,
                'category' => $category->id,
            ]));

        // assertions
        $this->assertAuthenticated();

        $this->assertDatabaseCount('products', 0);

        $response->assertForbidden();
    }
}
