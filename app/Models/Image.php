<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = ['imageable_id', 'imageable_type', 'url'];

    //! Relacion uno a uno polimorfica
    public function imageable()
    {
        return $this->morphTo();
    }
}
