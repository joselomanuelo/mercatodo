<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\View\View;

class BuyerProductsController extends Controller
{
    public function index(): View
    {
        $products = Product::paginate(20);

        return view('buyer.products.index', [
            'products' => $products,
        ]);
    }
}
