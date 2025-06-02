<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ColorController;

Route::resource('products', ProductController::class);
Route::resource('categories', CategoryController::class);
Route::resource('colors', ColorController::class);

Route::get('/', function () {
    return view('welcome');
});
