<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Http\Requests\Buyer\SearchProductsRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;

class BuyerProductsController extends Controller
{
    public function index(SearchProductsRequest|null $request): View
    {
        $categories = Category::all();

        if ($request->query('search')) {
            $search = trim($request->query('search'));

            if (
                $request->query('category')
                && $request->query('priceFrom')
                && $request->query('priceTo')
            ) {
                $category = $request->query('category');
                $priceFrom = $request->query('priceFrom');
                $priceTo = $request->query('priceTo');
                $products = Product::where('name', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%')
                    ->where('category_id', $category)
                    ->whereBetween('price', [$priceFrom, $priceTo])
                    ->paginate(20);
            } elseif (
                $request->query('category')
                && $request->query('priceFrom')
            ) {
                $category = $request->query('category');
                $priceFrom = $request->query('priceFrom');
                $products = Product::where('name', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%')
                    ->where('price', '>=', $priceFrom)
                    ->where('category_id', $category)
                    ->paginate(20);
            } elseif (
                $request->query('category')
                && $request->query('priceTo')
            ) {
                $category = $request->query('category');
                $priceTo = $request->query('priceTo');
                $products = Product::where('name', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%')
                    ->where('price', '<=', $priceTo)
                    ->where('category_id', $category)
                    ->paginate(20);
            } elseif (
                $request->query('priceFrom')
                && $request->query('priceTo')
            ) {
                $priceFrom = $request->query('priceFrom');
                $priceTo = $request->query('priceTo');
                $products = Product::where('name', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%')
                    ->whereBetween('price', [$priceFrom, $priceTo])
                    ->paginate(20);
            } elseif (
                $request->query('category')
            ) {
                $category = $request->query('category');
                $products = Product::where('name', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%')
                    ->where('category_id', $category)
                    ->paginate(20);
            } elseif (
                $request->query('priceFrom')
            ) {
                $priceFrom = $request->query('priceFrom');
                $products = Product::where('name', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%')
                    ->where('price', '>=', $priceFrom)
                    ->paginate(20);
            } elseif (
                $request->query('priceTo')
            ) {
                $priceTo = $request->query('priceTo');
                $products = Product::where('name', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%')
                    ->where('price', '<=', $priceTo)
                    ->paginate(20);
            } else {
                $products = Product::where('name', 'like', '%'.$search.'%')
                    ->orWhere('description', 'like', '%'.$search.'%')
                    ->paginate(20);
            }
        } else {
            $products = Product::paginate(20);
        }

        return view('buyer.products.index', compact('products', 'categories'));
    }

    public function show(Product $product): View
    {
        return view('buyer.products.show', compact('product'));
    }
}
