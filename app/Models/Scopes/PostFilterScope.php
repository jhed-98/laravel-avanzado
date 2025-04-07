<?php

namespace App\Models\Scopes;

use App\Enums\PostPublished;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class PostFilterScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        //! Query Scope Global
        if (!request()->routeIs('admin.*')) {
            $builder->where('published', PostPublished::Publicado);
        }
    }
}
