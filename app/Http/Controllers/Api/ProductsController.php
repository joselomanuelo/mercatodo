<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductsResource;
use App\Models\Product;

class ProductsController extends Controller
{
    public function index()
    {
        return ProductsResource::collection(Product::all());
    }
}
