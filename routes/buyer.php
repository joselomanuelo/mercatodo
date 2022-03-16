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

        Route::view('/cart', 'buyer.cart.index')
            ->name(RouteNames::BUYER_INDEX_CART);

        Route::view('/orders/show/{reference}', 'buyer.orders.show')
            ->middleware(['auth', 'verified'])
            ->name(RouteNames::BUYER_SHOW_ORDERS);

        Route::view('/orders', 'buyer.orders.index')
            ->middleware(['auth', 'verified'])
            ->name(RouteNames::BUYER_INDEX_ORDERS);
    });
