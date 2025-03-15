<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PostController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.index');
})->name('dashboard');

Route::resource('categories', CategoryController::class)
    ->names('categories')->except('show');
Route::resource('posts', PostController::class)
    ->names('posts')->except('show');
