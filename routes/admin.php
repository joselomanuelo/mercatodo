<?php

use App\Constants\Permissions;
use App\Constants\RouteNames;
use App\Http\Controllers\Admin\AdminProductController;
use App\Http\Controllers\Admin\AdminUserController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        // Users
        Route::get('/users', [AdminUserController::class, 'index'])
            ->middleware(['permission:' . Permissions::INDEX_USERS])
            ->name(RouteNames::INDEX_USERS);

        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])
            ->middleware(['permission:' . Permissions::DELETE_USERS])
            ->name(RouteNames::DESTROY_USERS);

        Route::get('users/{user}/edit', [AdminUserController::class, 'edit'])
            ->middleware(['permission:' . Permissions::UPDATE_USERS])
            ->name(RouteNames::EDIT_USERS);

        Route::put('/users/{user}', [AdminUserController::class, 'update'])
            ->middleware(['permission:' . Permissions::UPDATE_USERS])
            ->name(RouteNames::UPDATE_USERS);

        Route::get('/users/{user}', [AdminUserController::class, 'show'])
            ->middleware(['permission:' . Permissions::SHOW_USERS])
            ->name(RouteNames::SHOW_USERS);

        Route::put('users/{user}/toggle', [AdminUserController::class, 'toggle'])
            ->middleware(['permission:' . Permissions::UPDATE_USERS])
            ->name(RouteNames::TOGGLE_USERS);

        // Products
        Route::get('/products', [AdminProductController::class, 'index'])
            ->middleware(['permission:' . Permissions::INDEX_PRODUCTS])
            ->name(RouteNames::INDEX_PRODUCTS);

        Route::post('/products', [AdminProductController::class, 'store'])
            ->middleware(['permission:' . Permissions::CREATE_PRODUCTS])
            ->name(RouteNames::STORE_PRODUCTS);

        Route::get('/products/create', [AdminProductController::class, 'create'])
            ->middleware(['permission:' . Permissions::CREATE_PRODUCTS])
            ->name(RouteNames::CREATE_PRODUCTS);

        Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])
            ->middleware(['permission:' . Permissions::DELETE_PRODUCTS])
            ->name(RouteNames::DESTROY_PRODUCTS);

        Route::get('products/{product}/edit', [AdminProductController::class, 'edit'])
            ->middleware(['permission:' . Permissions::UPDATE_PRODUCTS])
            ->name(RouteNames::EDIT_PRODUCTS);

        Route::put('/products/{product}', [AdminProductController::class, 'update'])
            ->middleware(['permission:' . Permissions::UPDATE_PRODUCTS])
            ->name(RouteNames::UPDATE_PRODUCTS);

        Route::get('/products/{product}', [AdminProductController::class, 'show'])
            ->middleware(['permission:' . Permissions::SHOW_PRODUCTS])
            ->name(RouteNames::SHOW_PRODUCTS);

        Route::get('/export/products', [AdminProductController::class, 'export'])
            ->middleware(['permission:' . Permissions::EXPORT_PRODUCTS])
            ->name(RouteNames::EXPORT_PRODUCTS);
    });
