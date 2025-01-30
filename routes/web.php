<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/',  HomeController::class)->name('home');
Route::view('/blade-template', 'blade-template');

Route::resource('articulos', PostController::class)
    ->parameters(['articulos' => 'post'])
    ->names('posts');

Route::view('/articulos-old', 'posts.index-old');

Route::get('prueba', function () {
    $data = \App\Models\Post::find(1);

    // $data->tags()->attach([1 => ['data' => 'hola']]);

    return $data->tags;
});

//! Agrupar rutas en un mismo controlador
// Route::prefix('articulos')->name('posts.')->controller(ArticleController::class)->group(function () {
//     //Definir rutas adicionales
//     Route::get('/', 'index')->name('index');
//     Route::get('/export', 'export')->name('export');
//     Route::get('/consult', 'consult')->name('consult');
// });

//! Para crear cache de rutas solo se aplica cuando el proyecto esta en produccion
// php artisan route:cache

//! Para eliminar cache de rutas
// php artisan route:clear
