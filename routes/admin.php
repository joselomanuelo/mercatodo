<?php

use App\Http\Controllers\Admin\UsersController;
use Illuminate\Support\Facades\Route;

Route::get('/admin/users', [UsersController::class, 'index'])
            ->middleware(['auth', 'verified'])
            ->name('admin.users');

Route::delete('/admin/users/{user}', [UsersController::class, 'destroy'])
            ->middleware(['auth', 'verified'])
            ->name('admin.users.destroy');

Route::get('/admin/{user}/edit', [UsersController::class, 'edit'])
            ->middleware(['auth', 'verified'])
            ->name('admin.users.edit');

Route::put('/admin/{user}/update', [UsersController::class, 'update'])
            ->middleware(['auth', 'verified'])
            ->name('admin.users.update');

Route::get('/admin/{user}/show', [UsersController::class, 'show'])
            ->middleware(['auth', 'verified'])
            ->name('admin.users.show');