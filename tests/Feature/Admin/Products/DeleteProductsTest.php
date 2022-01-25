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

class DeleteProductsTest extends TestCase
{
    use RefreshDatabase;

    public function testProductCanBeDelete(): void
    {
        $deleteProductsPermission = Permission::create(['name' => Permissions::DELETE_PRODUCTS]);

        $adminRole = Role::create(['name' => Roles::ADMIN])
            ->givePermissionTo($deleteProductsPermission);

        $admin = User::factory()
            ->create()
            ->assignRole($adminRole);

        $productToDelete = Product::factory()
            ->for(Category::factory()->create())
            ->create();

        $response = $this->actingAs($admin)
            ->delete($productToDelete->destroyRoute());

        // assertions
        $response->assertRedirect(Product::indexRoute());
        $this->assertAuthenticated();
        $this->assertDatabaseCount('products', 0);
        $this->assertDeleted($productToDelete);
    }

    public function testNotAdminUserCantDeleteProducts(): void
    {
        $buyerRole = Role::create(['name' => Roles::BUYER]);

        $buyer = User::factory()
            ->create()
            ->assignRole($buyerRole);

        $productToDelete = Product::factory()
            ->for(Category::factory()->create())
            ->create();

        $response = $this->actingAs($buyer)
            ->delete($productToDelete->destroyRoute());

        // assertions
        $response->assertForbidden();
        $this->assertAuthenticated();
        $this->assertDatabaseCount('products', 1);
        $this->assertModelExists($productToDelete);
    }
}
