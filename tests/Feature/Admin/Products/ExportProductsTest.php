<?php

namespace Tests\Feature\Admin\Products;

use App\Constants\Permissions;
use App\Constants\Roles;
use App\Exports\ProductsExport;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class ExportProductsTest extends TestCase
{
    use RefreshDatabase;

    public function testProductsExcelCanBeDownload(): void
    {
        Excel::fake();

        Product::factory()->count(10)->create();

        $createProductsPermission = Permission::create([
            'name' => Permissions::EXPORT_PRODUCTS,
        ]);

        $adminRole = Role::create(['name' => Roles::ADMIN])
        ->givePermissionTo($createProductsPermission);

        $admin = User::factory()
        ->create()
        ->assignRole($adminRole);

        $this->actingAs($admin)
        ->get(route('admin.products.export'));

        Excel::assertDownloaded('products.xlsx', function (ProductsExport $export) {
            $products = Product::all();
            $product = Product::first();
            $headings = [
                'id',
                'name',
                'description',
                'price',
                'stock',
                'reserved_stock',
                'product_image',
                'category_id',
            ];
            $mapping = [
                $product->id,
                $product->name,
                $product->description,
                $product->price,
                $product->stock,
                $product->reserved_stock,
                $product->product_image,
                $product->category_id,
            ];
            return $export->collection()->contains($product &&
                $export->headings() === $headings &&
                $export->map($product) === $mapping);
        });
    }
}
