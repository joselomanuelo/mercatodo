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

class ShowProductsTest extends TestCase
{
    use RefreshDatabase;

    public function testShowProductScreenCanBeRendered(): void
    {
        $showProductsPermission = Permission::create(['name' => Permissions::SHOW_PRODUCTS]);

        $adminRole = Role::create(['name' => Roles::ADMIN])
            ->givePermissionTo($showProductsPermission);

        $admin = User::factory()
            ->create()
            ->assignRole($adminRole);

        $product = Product::factory()
            ->for(Category::factory()->create())
            ->create();

        $response = $this->actingAs($admin)
            ->get($product->showRoute());

        // assertions
        $response->assertOk();
        $response->assertViewIs(Product::showView());
        $this->assertAuthenticated();
        $this->assertDatabaseCount('products', 1);
    }

    public function testNotAdminUserCantSeeProducts(): void
    {
        $buyerRole = Role::create(['name' => Roles::BUYER]);

        $user = User::factory()
            ->create()
            ->assignRole($buyerRole);

        $product = Product::factory()
            ->for(Category::factory()->create())
            ->create();

        $response = $this->actingAs($user)
            ->get($product->showRoute());

        // assertions
        $response->assertForbidden();
        $this->assertAuthenticated();
        $this->assertDatabaseCount('products', 1);
    }
}
