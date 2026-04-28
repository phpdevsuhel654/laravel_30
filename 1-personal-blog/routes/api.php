<?php
// routes/api.php
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;

Route::apiResource('blogs', BlogController::class);
Route::apiResource('categories', CategoryController::class);
Route::apiResource('tags', TagController::class);
