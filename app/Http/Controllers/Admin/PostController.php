<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostRequest;
use App\Models\Category;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $posts = Post::latest('id')->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('admin.posts.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PostRequest $request)
    {
        $post = Post::create($request->all());

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'El post se creo correctamente.',
        ]);

        return redirect()->route('admin.posts.index');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        $categories = Category::all();
        // $tags = Tag::all();
        $data = [
            "post" => $post,
            "categories" => $categories,
            // "tags" => $tags,
        ];
        return view('admin.posts.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PostRequest $request, Post $post)
    {
        $data = $request->all();
        $tags = [];
        foreach ($request->tags ?? [] as $name) {
            $tag = Tag::firstOrCreate(['name' => $name]);
            $tags[] = $tag->id;
        }
        $post->tags()->sync($tags);

        if ($request->file('image')) {
            if ($post->image_path) {
                Storage::delete($post->image_path);
            }
            //! Method 1
            // $data['image_path'] = Storage::put('posts', $request->image);
            //! Method 2
            // $file_name = $request->slug . '.' . $request->file('image')->getClientOriginalExtension();
            // $data['image_path'] = Storage::putFileAs('posts', $request->image, $file_name);
            //! Method 3
            // $data['image_path'] = $request->file('image')->store('post');
            //! Method 4
            $file_name = $request->slug . '.' . $request->file('image')->getClientOriginalExtension();
            $data['image_path'] = $request->file('image')->storeAs('posts', $file_name);
        }

        $post->update($data);

        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'El post se actualizo correctamente.',
        ]);

        return redirect()->route('admin.posts.edit', $post);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Post $post)
    {
        $post->delete();
        session()->flash('swal', [
            'icon' => 'success',
            'title' => '¡Bien hecho!',
            'text' => 'El post se eliminó correctamente.',
        ]);
        return redirect()->route('admin.posts.index');
    }
}
