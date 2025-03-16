<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/',  HomeController::class)->name('home');
Route::view('/blade-template', 'blade-template');

Route::view('/articulos-old', 'posts.index-old');

Route::resource('articulos', PostController::class)
    ->parameters(['articulos' => 'post'])
    ->names('posts');

Route::get('/posts/{post}/image', [PostController::class, 'image_s3'])->name('posts.image_s3');

//! Agrupar rutas en un mismo controlador
// Route::prefix('articulos')->name('posts.')->controller(PostController::class)->group(function () {
//     //Definir rutas adicionales
//     Route::get('/', 'index')->name('index');
//     Route::post('/', 'store')->name('store');
//     Route::get('/create', 'create')->name('create');
//     Route::get('/{post}', 'show')->name('show');
//     Route::match(['put', 'patch'], '/{post}', 'update')->name('update');
//     Route::delete('/{post}', 'destroy')->name('destroy');
//     Route::get('/{post}/editar', 'edit')->name('edit');
// });

//! Para crear cache de rutas solo se aplica cuando el proyecto esta en produccion
// php artisan route:cache

//! Para eliminar cache de rutas
// php artisan route:clear

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
