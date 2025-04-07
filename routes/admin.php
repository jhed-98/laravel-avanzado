<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.index');
})->name('dashboard')
    ->middleware(['can:Acceso panel']);

Route::resource('categories', CategoryController::class)
    ->names('categories')->except('show')
    ->middleware(['can:Gestion de categorias']);

Route::resource('posts', PostController::class)
    ->names('posts')->except('show')
    ->middleware(['can:Gestion de articulos']);

Route::resource('roles', RoleController::class)->names('roles')->except('show')
    ->middleware(['can:Gestion de roles']);

Route::resource('permissions', PermissionController::class)->names('permissions')->except('show')
    ->middleware(['can:Gestion de permisos']);

Route::resource('users', UserController::class)->names('users')->except('create', 'store', 'show')
    ->middleware(['can:Gestion de usuarios']);
