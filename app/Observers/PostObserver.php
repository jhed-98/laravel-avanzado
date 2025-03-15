<?php

namespace App\Observers;

use App\Enums\PostPublished;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class PostObserver
{
    //! Antes de registrar de datos
    public function creating(Post $post)
    {
        if (!app()->runningInConsole()) $post->user_id = Auth::user()->id;
    }

    //!
    public function updating(Post $post)
    {
        if ($post->published->value == PostPublished::Publicado->value && !$post->published_at) {
            $post->published_at = now();
        }
    }
}
