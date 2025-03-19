<?php

namespace App\Models;

use App\Enums\PostPublished;
use App\Observers\PostObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

#[ObservedBy([PostObserver::class])]
class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    //! Enums
    protected $casts = [
        'published' => PostPublished::class,
    ];

    //! Attribute
    protected function title(): Attribute
    {
        return new Attribute(
            //! - Mutadores
            set: fn($value) => strtolower($value),
            //! - Accessor
            get: fn($value) => ucfirst($value),
        );
    }
    protected function image(): Attribute
    {
        return new Attribute(
            /* get: fn() => $this->image_path ?? asset('image/photo.png'), */
            get: function () {
                if ($this->image_path) {
                    //Verificar si la url comienza con https:// o http://
                    if (substr($this->image_path, 0, 8) === 'https://') {
                        return $this->image_path;
                    }
                    //! public - s3 (public)
                    return Storage::url($this->image_path);
                    //! s3 (privado) - URL Temporal
                    // return Storage::disk('s3')->temporaryUrl($this->image_path, now()->addMinutes(30));
                    //! s3 (privado) - URL
                    // return route('posts.image_s3', $this);
                } else {
                    return asset('image/photo.png');
                }
            }
        );
    }

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
