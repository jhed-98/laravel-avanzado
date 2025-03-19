<?php

use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/tags', function (Request $request) {
    $term = $request->term ?? '';
    $tags = Tag::select('name')
        ->where('name', 'LIKE', '%' . $term . '%')
        ->limit(10)
        ->get()->map(function ($tag) {
            return [
                'id' => $tag->name,
                'text' => $tag->name,
            ];
        });
    return $tags;
})->name('tags.index');

Route::post('/images/upload', function (Request $request) {
    $path = Storage::put('images', $request->upload);
    return ['url' => Storage::url($path)];
})->name('images.upload');
