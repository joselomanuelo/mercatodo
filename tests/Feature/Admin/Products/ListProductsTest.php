<?php

namespace Tests\Feature\Products;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ListproductsTest extends TestCase
{
    use RefreshDatabase;

    public function testProductsListScreenCanBeRendered(): void
    {
        $indexProductsPermission = Permission::create(['name' => 'index products']);

        $adminRole = Role::create(['name' => 'admin'])
            ->givePermissionTo($indexProductsPermission);

        $admin = User::factory()
            ->create()
            ->assignRole($adminRole);

        $response = $this->actingAs($admin)
            ->get(route('admin.products.index'));

        // assertions
        $this->assertAuthenticated();

        $this->assertDatabaseCount('users', 1);

        $response->assertViewIs('admin.products');

        $response->assertOk();
    }

    public function testUnauthenticatedUserCantRenderProductsListScreen(): void
    {
        $response = $this->get(route('admin.products.index'));

        // assertions
        $this->assertGuest();

        $this->assertDatabaseCount('users', 0);

        $response->assertRedirect(route('login'));
    }
}
