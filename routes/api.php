<?php

use App\Constants\RouteNames;
use App\Http\Controllers\Api\ApiCategoryController;
use App\Http\Controllers\Api\ApiOrderController;
use App\Http\Controllers\Api\ApiProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use PHPUnit\TextUI\XmlConfiguration\Group;

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
Route::middleware(['auth:api'])
    ->group(function () {
        Route::get('orders', [ApiOrderController::class, 'index'])
        ->name(RouteNames::API_ORDERS);

        Route::post('orders', [ApiOrderController::class, 'store'])
        ->name(RouteNames::API_STORE_ORDERS);

        Route::get('orders/{reference}/show', [ApiOrderController::class, 'show'])
        ->name(RouteNames::API_SHOW_ORDERS);
    });

    Route::get('categories', [ApiCategoryController::class, 'index'])
    ->name(RouteNames::API_CATEGORIES);

    Route::get('products', [ApiProductController::class, 'index'])
    ->name(RouteNames::API_PRODUCTS);
