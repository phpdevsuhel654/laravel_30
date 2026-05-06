<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application.
| These routes are loaded by the RouteServiceProvider within a group
| which contains the "web" middleware group. Now create something great!
|
*/

// Home route
Route::get('/', function () {
    return redirect()->route('blogs.index');
});

// Blog routes
Route::resource('blogs', BlogController::class);

// Category routes
Route::resource('categories', CategoryController::class);

// Tag routes
Route::resource('tags', TagController::class);
