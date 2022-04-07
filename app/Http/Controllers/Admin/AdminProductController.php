<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Products\StoreOrUpdateAction;
use App\Exports\ProductsExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Products\ProductRequest;
use App\Http\Requests\Admin\Products\SearchRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Maatwebsite\Excel\Facades\Excel;

class AdminProductController extends Controller
{
    public function index(SearchRequest $request): View
    {
        $products = Product::search($request->query('search'))
            ->where('stock', '>', 0)
            ->orderBy('name')
            ->paginate(20);

        $products->appends(['search' => $request->query('search')]);

        return view(Product::indexView(), compact('products'));
    }

    public function create(): View
    {
        $categories = Category::categoriesFromCache();

        return view(Product::createView(), compact('categories'));
    }

    public function store(ProductRequest $request): RedirectResponse
    {
        StoreOrUpdateAction::execute($request);

        return redirect(Product::indexRoute());
    }

    public function show(Product $product): View
    {
        return view(Product::showView(), compact('product'));
    }

    public function edit(Product $product): View
    {
        $categories = Category::categoriesFromCache();

        return view(Product::editView(), compact('product', 'categories'));
    }

    public function update(ProductRequest $request, Product $product): RedirectResponse
    {
        StoreOrUpdateAction::execute($request, $product);

        return redirect(Product::indexRoute());
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        Storage::disk('public')->delete($product->product_image);

        return redirect(Product::indexRoute());
    }

    public function export()
    {
        return Excel::download(new ProductsExport(), 'products.xlsx');
    }
}
