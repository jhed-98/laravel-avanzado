<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function image_s3(Post $post)
    {
        $img = Storage::get($post->image_path); // Recupera el objeto de la image
        return response($img)->header('Content-Type', 'image/jpeg');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest()->paginate(5);
        return view('posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        // Create Mass Assignment
        Post::create(
            [
                'title' => $request->title,
                // 'slug' => str()->slug($request->title),
                'slug' => $request->slug,
                'content' => $request->content,
                'category_id' => $request->category_id,
                'user_id' => '1'
            ]
        );
        // // Create Manual
        // $post = new Post();
        // $post->title = $request->title;
        // $post->slug = str()->slug($request->title);
        // $post->content = $request->content;
        // $post->category_id = $request->category_id;
        // $post->user_id = '1';
        // $post->save();

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Post $post)
    {
        // $post = Post::find($post);
        return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        // $post = Post::find($post);
        $categories = Category::all();
        return view('posts.edit', compact('post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        // $post = Post::find($post);
        $post->update(
            [
                'title' => $request->title,
                // 'slug' => str()->slug($request->slug),
                'slug' => $request->slug,
                'content' => $request->content,
                'category_id' => $request->category_id,
                'user_id' => '1'
            ]
        );

        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        // $post = Post::find($post);
        $post->delete();

        return redirect()->route('posts.index');
    }
}
