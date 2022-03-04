<?php

use App\Constants\RouteNames;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/* Route::get('/', function () {
    return view('welcome');
})->name('welcome'); */

Route::view('/', 'welcome')
    ->name(RouteNames::WELCOME);

Route::view('/dashboard', 'welcome')
    ->middleware(['auth', 'verified'])
    ->name(RouteNames::DASHBOARD);

require __DIR__ . '/auth.php';

require __DIR__ . '/admin.php';

require __DIR__ . '/buyer.php';
