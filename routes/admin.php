<?php

use App\Constants\Permissions;
use App\Constants\RouteNames;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        // Users
        Route::get('/users', [UsersController::class, 'index'])
            ->middleware(['permission:'.Permissions::INDEX_USERS])
            ->name(RouteNames::INDEX_USERS);

        Route::delete('/users/{user}', [UsersController::class, 'destroy'])
            ->middleware(['permission:'.Permissions::DELETE_USERS])
            ->name(RouteNames::DESTROY_USERS);

        Route::get('users/{user}/edit', [UsersController::class, 'edit'])
            ->middleware(['permission:'.Permissions::UPDATE_USERS])
            ->name(RouteNames::EDIT_USERS);

        Route::put('/users/{user}', [UsersController::class, 'update'])
            ->middleware(['permission:'.Permissions::UPDATE_USERS])
            ->name(RouteNames::UPDATE_USERS);

        Route::get('/users/{user}', [UsersController::class, 'show'])
            ->middleware(['permission:'.Permissions::SHOW_USERS])
            ->name(RouteNames::SHOW_USERS);

        Route::put('users/{user}/toggle', [UsersController::class, 'toggle'])
            ->middleware(['permission:'.Permissions::UPDATE_USERS])
            ->name(RouteNames::TOGGLE_USERS);

        // Products
        Route::get('/products', [ProductsController::class, 'index'])
            ->middleware(['permission:'.Permissions::INDEX_PRODUCTS])
            ->name(RouteNames::INDEX_PRODUCTS);

        Route::post('/products', [ProductsController::class, 'store'])
            ->middleware(['permission:'.Permissions::CREATE_PRODUCTS])
            ->name(RouteNames::STORE_PRODUCTS);

        Route::get('/products/create', [ProductsController::class, 'create'])
            ->middleware(['permission:'.Permissions::CREATE_PRODUCTS])
            ->name(RouteNames::CREATE_PRODUCTS);

        Route::delete('/products/{product}', [ProductsController::class, 'destroy'])
            ->middleware(['permission:'.Permissions::DELETE_PRODUCTS])
            ->name(RouteNames::DESTROY_PRODUCTS);

        Route::get('products/{product}/edit', [ProductsController::class, 'edit'])
            ->middleware(['permission:'.Permissions::UPDATE_PRODUCTS])
            ->name(RouteNames::EDIT_PRODUCTS);

        Route::put('/products/{product}', [ProductsController::class, 'update'])
            ->middleware(['permission:'.Permissions::UPDATE_PRODUCTS])
            ->name(RouteNames::UPDATE_PRODUCTS);

        Route::get('/products/{product}', [ProductsController::class, 'show'])
            ->middleware(['permission:'.Permissions::SHOW_PRODUCTS])
            ->name(RouteNames::SHOW_PRODUCTS);
    });
