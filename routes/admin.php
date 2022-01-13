<?php

use App\Constants\Permissions;
use App\Http\Controllers\Admin\ProductsController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        // Users
        Route::get('/users', [UsersController::class, 'index'])
            ->middleware(['permission:'.Permissions::INDEX_USERS])
            ->name('users.index');

        Route::delete('/users/{user}', [UsersController::class, 'destroy'])
            ->middleware(['permission:'.Permissions::DELETE_USERS])
            ->name('users.destroy');

        Route::get('users/{user}/edit', [UsersController::class, 'edit'])
            ->middleware(['permission:'.Permissions::UPDATE_USERS])
            ->name('users.edit');

        Route::put('/users/{user}', [UsersController::class, 'update'])
            ->middleware(['permission:'.Permissions::UPDATE_USERS])
            ->name('users.update');

        Route::get('/users/{user}', [UsersController::class, 'show'])
            ->middleware(['permission:'.Permissions::SHOW_USERS])
            ->name('users.show');

        Route::put('users/{user}/toggle', [UsersController::class, 'toggle'])
            ->middleware(['permission:'.Permissions::UPDATE_USERS])
            ->name('users.toggle');

        // Products
        Route::get('/products', [ProductsController::class, 'index'])
            ->middleware(['permission:'.Permissions::INDEX_PRODUCTS])
            ->name('products.index');

        Route::post('/products', [ProductsController::class, 'store'])
            ->middleware(['permission:'.Permissions::CREATE_PRODUCTS])
            ->name('products.store');

        Route::get('/products/create', [ProductsController::class, 'create'])
            ->middleware(['permission:'.Permissions::CREATE_PRODUCTS])
            ->name('products.create');

        Route::delete('/products/{product}', [ProductsController::class, 'destroy'])
            ->middleware(['permission:'.Permissions::DELETE_PRODUCTS])
            ->name('products.destroy');

        Route::get('products/{product}/edit', [ProductsController::class, 'edit'])
            ->middleware(['permission:'.Permissions::UPDATE_PRODUCTS])
            ->name('products.edit');

        Route::put('/products/{product}', [ProductsController::class, 'update'])
            ->middleware(['permission:'.Permissions::UPDATE_PRODUCTS])
            ->name('products.update');

        Route::get('/products/{product}', [ProductsController::class, 'show'])
            ->middleware(['permission:'.Permissions::SHOW_PRODUCTS])
            ->name('products.show');
    });
