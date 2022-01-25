<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Products\StoreOrUpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class ProductsController extends Controller
{
    public function index(): View
    {
        $products = Product::paginate(50);

        return view('admin.products.index', compact('products'));
    }

    public function create(): View
    {
        $categories = Category::categoriesFromCache();

        return view('admin.products.create', compact('categories'));
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
        StoreOrUpdateAction::execute($request);

        return redirect(Product::indexRoute());
    }

    public function show(Product $product): View
    {
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product): View
    {
        $categories = Category::categoriesFromCache();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
        StoreOrUpdateAction::execute($request, $product);

        return redirect(Product::indexRoute());
    }

    public function destroy(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect(Product::indexRoute());
    }
}
