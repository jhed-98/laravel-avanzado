<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    //! Ruta personalizada
    public function getRouteKeyName()
    {
        return 'slug';
    }

    //! Relacion uno a muchos inversa
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    //! Relacion muchos a muchos
    // public function tags()
    // {
    //     return $this->belongsToMany(Tag::class)
    //         ->withPivot('data')
    //         ->withTimestamps();
    // }

    //! Relacion uno a muchos polimorfica
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    //! Relacion uno a muchos polimorfica
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    //! Relacion muchos a muchos polimorfica
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable')
            ->withTimestamps();
    }
}
