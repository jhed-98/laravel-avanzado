<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /** @use HasFactory<\Database\Factories\TagFactory> */
    use HasFactory;

    //! Relacion muchos a muchos inversa
    // public function posts()
    // {
    //     return $this->belongsToMany(Post::class);
    // }

    //! Relacion muchos a muchos polimorfica inversa
    public function posts()
    {
        return $this->morphedByMany(Tag::class, 'taggable');
    }
    public function courses()
    {
        return $this->morphedByMany(Course::class, 'taggable');
    }
}
