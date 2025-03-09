<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['commentable_id', 'commentable_type', 'body'];

    //! Relacion uno a muchos polimorfica
    public function commentable()
    {
        return $this->morphTo();
    }
    //! Relacion uno a muchos inversa
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
