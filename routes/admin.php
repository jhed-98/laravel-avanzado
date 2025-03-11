<?php

use App\Http\Controllers\Admin\CategoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.index');
})->name('dashboard');

Route::resource('categories', CategoryController::class)
    ->names('categories')->except('show');
