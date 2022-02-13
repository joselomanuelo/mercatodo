<?php

use App\Constants\RouteNames;
use App\Http\Controllers\Buyer\BuyerProductsController;
use Illuminate\Support\Facades\Route;

Route::prefix('buyer')
    ->group(function () {
        Route::get('/products', [BuyerProductsController::class, 'index'])
            ->name(RouteNames::BUYER_INDEX_PRODUCTS);

        Route::get('/products/{product}/show', [BuyerProductsController::class, 'show'])
            ->name(RouteNames::BUYER_SHOW_PRODUCTS);

        Route::view('/productsVue', 'buyer.products.indexVue');
    });
