<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Buyer\SearchProductsRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class BuyerProductsController extends Controller
{
    public function index(SearchProductsRequest $request): View
    {
        $categories = Category::all();

        $products = Product::search($request->query('search'))
            ->categoryFilter($request->query('category'))
            ->priceFilter($request->query('priceFrom'), $request->query('priceTo'))
            ->paginate(20);

        $products->appends(['search' => $request->query('search'),
            'category' => $request->query('category'),
            'priceFrom' => $request->query('priceFrom'),
            'priceTo' => $request->query('priceTo'),
    ]);

        return view(Product::buyerIndexView(), compact('products', 'categories'));
    }

    public function show(Product $product): View
    {
        return view(Product::buyerShowView(), compact('product'));
    }
}
