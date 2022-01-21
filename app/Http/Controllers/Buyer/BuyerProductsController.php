<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Buyer\SearchProductsRequest;
use App\Models\Product;
use Illuminate\View\View;

class BuyerProductsController extends Controller
{
    public function index(SearchProductsRequest|null $request): View
    {
        if ($request->query('search')) {
            $search = trim($request->query('search'));

            $products = Product::where('name', 'like', '%'.$search.'%')
                ->paginate(20);
        } else {
            $products = Product::paginate(20);
        }

        return view('buyer.products.index', compact('products'));
    }

    public function show(Product $product): View
    {
        return view('buyer.products.show', compact('product'));
    }

    /* public function search(SearchProductsRequest $request): View
    {
        $search = trim($request->query('search'));

        $products = Product::where('name', 'like', '%'.$search.'%')
            ->paginate(20);

        return view('buyer.products.search', compact('products'));
    } */
}
