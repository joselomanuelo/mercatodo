<?php

use App\Constants\RouteNames;
use App\Http\Controllers\Api\CategoriesController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('categories', [CategoriesController::class, 'index'])
    ->name(RouteNames::CATEGORIES);

Route::get('products', [ProductsController::class, 'index'])
    ->name(RouteNames::PRODUCTS);

Route::get('orders', [OrdersController::class, 'index'])
    ->name(RouteNames::ORDERS);
