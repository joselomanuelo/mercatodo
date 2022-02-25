<?php

use App\Constants\RouteNames;
use App\Http\Controllers\Api\CategoriesController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\OrdersController;
use App\Http\Controllers\Api\ProductsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/user', function (Request $request) {
    return response()->json(['user' => $request->user()]);
});

Route::get('/login', [LoginController::class, 'create'])
    ->name(RouteNames::API_LOGIN_VIEW);

Route::post('/login', [LoginController::class, 'store'])
    ->name(RouteNames::API_LOGIN_ATTEMP);

Route::middleware('auth:sanctum')
    ->group(function () {
        Route::get('categories', [CategoriesController::class, 'index'])
            ->name(RouteNames::API_CATEGORIES);

        Route::get('products', [ProductsController::class, 'index'])
            ->name(RouteNames::API_PRODUCTS);

        Route::get('orders', [OrdersController::class, 'index'])
            ->name(RouteNames::API_ORDERS);

        Route::post('orders', [OrdersController::class, 'store'])
            ->name(RouteNames::API_STORE_ORDERS);
    });
