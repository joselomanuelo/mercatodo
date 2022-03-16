<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductsResource;
use App\Models\Product;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class ProductsController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $products = Product::where('stock', '>', 0)->get();

        return ProductsResource::collection($products);
    }
}
