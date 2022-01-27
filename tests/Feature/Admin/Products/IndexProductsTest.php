<?php

namespace tests\Feature\Admin\Products;

use App\Constants\Permissions;
use App\Constants\Roles;
use App\Constants\RouteNames;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class IndexproductsTest extends TestCase
{
    use RefreshDatabase;

    public function testProductsListScreenCanBeRendered(): void
    {
        $indexProductsPermission = Permission::create(['name' => Permissions::INDEX_PRODUCTS]);

        $adminRole = Role::create(['name' => Roles::ADMIN])
            ->givePermissionTo($indexProductsPermission);

        $admin = User::factory()
            ->create()
            ->assignRole($adminRole);

        $response = $this->actingAs($admin)
            ->get(Product::indexRoute());

        // assertions
        $response->assertOk();
        $response->assertViewIs(Product::indexView());
        $this->assertAuthenticated();
    }

    public function testUnauthenticatedUserCantRenderProductsListScreen(): void
    {
        $response = $this->get(Product::indexRoute());

        // assertions
        $response->assertRedirect(route(RouteNames::LOGIN));
        $this->assertGuest();
    }
}
