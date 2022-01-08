<?php

use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

// Users administration routes
/*
Route::get('/admin/users', [UsersController::class, 'index'])
    ->middleware(['auth', 'verified', 'can:viewAny,App\Models\User'])
    ->name('admin.users');

Route::delete('/admin/users/{user}', [UsersController::class, 'destroy'])
    ->middleware(['auth', 'verified', 'can:delete,user'])
    ->name('admin.users.destroy');

Route::get('/admin/{user}/edit', [UsersController::class, 'edit'])
    ->middleware(['auth', 'verified', 'can:update,user'])
    ->name('admin.users.edit');

Route::put('/admin/{user}/update', [UsersController::class, 'update'])
    ->middleware(['auth', 'verified', 'can:update,user'])
    ->name('admin.users.update');

Route::get('/admin/{user}/show', [UsersController::class, 'show'])
    ->middleware(['auth', 'verified', 'can:view,user'])
    ->name('admin.users.show');
*/

Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', 'verified'])
    ->group(function () {
        Route::get('/users', [UsersController::class, 'index'])
            ->middleware(['permission:index users'])
            ->name('users');

        Route::delete('/users/{user}', [UsersController::class, 'destroy'])
            ->middleware(['permission:delete users'])
            ->name('users.destroy');

        Route::get('users/{user}/edit', [UsersController::class, 'edit'])
            ->middleware(['permission:update users'])
            ->name('users.edit');

        Route::put('/users/{user}', [UsersController::class, 'update'])
            ->middleware(['permission:update users'])
            ->name('users.update');

        Route::get('/users/{user}', [UsersController::class, 'show'])
            ->middleware(['permission:show users'])
            ->name('users.show');

        Route::put('users/{user}/toggle', [UsersController::class, 'toggle'])
            ->middleware(['permission:update users'])
            ->name('users.toggle');

        Route::resource('products', ProductController::class)
        ->middleware(['permission:index products']);
    });
