<?php

namespace App\Http\Controllers;

use App\Enums\PostPublished;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __invoke()
    {
        $categories = Category::all();

        $posts = Post::filter(request()->all())
            ->orderBy('id', 'desc')
            ->latest('id')->paginate();
        return view('welcome', compact('posts', 'categories'));
    }
}
