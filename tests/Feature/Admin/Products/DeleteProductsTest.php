<?php

namespace tests\Feature\Admin;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class DeleteProductsTest extends TestCase
{
    use RefreshDatabase;

    public function testProductCanBeDelete(): void
    {
        $deleteProductsPermission = Permission::create(['name' => 'delete products']);

        $adminRole = Role::create(['name' => 'admin'])
            ->givePermissionTo($deleteProductsPermission);

        $admin = User::factory()
            ->create()
            ->assignRole($adminRole);

        $productToDelete = Product::factory()
            ->for(Category::factory()->create())
            ->create();

        $response = $this->actingAs($admin)
            ->delete(route('admin.products.destroy', $productToDelete));

        // assertions
        $this->assertAuthenticated();

        $response->assertRedirect(route('admin.products.index'));

        $this->assertDatabaseCount('products', 0);

        $this->assertDeleted($productToDelete);

    }

    public function testNotAdminUserCantDeleteProducts(): void
    {
        $buyerRole = Role::create(['name' => 'buyer']);

        $user = User::factory()
            ->create()
            ->assignRole($buyerRole);

        $productToDelete = Product::factory()
            ->for(Category::factory()->create())
            ->create();

        $response = $this->actingAs($user)
            ->delete(route('admin.products.destroy', $productToDelete));

        // assertions
        $this->assertAuthenticated();

        $response->assertForbidden();

        $this->assertDatabaseCount('products', 1);

        $this->assertModelExists($productToDelete);

        
    }
}
