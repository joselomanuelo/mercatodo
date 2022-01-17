<?php

use App\Http\Controllers\Buyer\BuyerProductsController;
use Illuminate\Support\Facades\Route;

Route::prefix('buyer')
    ->name('buyer.')
    ->group(function () {
        Route::get('/products', [BuyerProductsController::class, 'index'])
            ->name('products');
    });
