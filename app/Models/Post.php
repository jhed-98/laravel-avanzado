<?php

namespace App\Models;

use App\Enums\PostPublished;
use App\Models\Scopes\PostFilterScope;
use App\Observers\PostObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

#[ObservedBy([PostObserver::class])]
class Post extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    //! Enums
    protected $casts = [
        'published' => PostPublished::class,
        'published_at' => 'datetime',
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
    protected function publishedtime(): Attribute
    {
        return new Attribute(
            get: function () {
                if ($this->published_at) {
                    return $this->published_at->format('d M Y');
                } else {
                    return $this->created_at->format('d M Y');
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

    //! Query Scope Local
    public function scopeFilter($query, $filters)
    {
        $query
            ->when($filters['category'] ?? null, function ($q, $category) {
                $q->whereIn('category_id', $category);
            })
            ->when($filters['order'] ?? 'new', function ($q, $order) {
                $sort = $order === 'new' ? 'desc' : 'asc';
                $q->orderBy('published_at', $sort);
            })
            ->when($filters['tag'] ?? null, function ($q, $tag) {
                $q->whereHas('tags', function ($q) use ($tag) {
                    $q->where('tags.name', $tag);
                });
            });
    }
    //! Query Scope Global
    protected static function booted(): void
    {
        //! Method 2
        static::addGlobalScope(new PostFilterScope);
        //! Method 3
        static::addGlobalScope('written', function ($builder) {
            if (request()->routeIs('admin.*')) {
                $builder->where('user_id', Auth::id());
            }
        });
    }
}
