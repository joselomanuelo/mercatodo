<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    public function index(): Response
    {
        $products = Product::paginate(50);

        return view('admin.products.index', [
            'products' => $products,
        ]);
    }

    public function create(): Response
    {
    }

    public function store(StoreProductRequest $request): RedirectResponse
    {
    }

    public function show(Product $product): Response
    {
    }

    public function edit(Product $product): Response
    {
    }

    public function update(UpdateProductRequest $request, Product $product): RedirectResponse
    {
    }

    public function destroy(Product $product): RedirectResponse
    {
    }
}
