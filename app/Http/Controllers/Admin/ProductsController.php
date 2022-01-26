<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Products\StoreOrUpdateAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductsController extends Controller
{
    public function index(): View
    {
        $products = Product::paginate(50);

        return view(Product::indexView(), compact('products'));
    }

    public function create(): View
    {
        $categories = Category::categoriesFromCache();

        return view(Product::createView(), compact('categories'));
    }

    public function store(StoreProductRequest $request): RedirectResponse
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

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
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
}
