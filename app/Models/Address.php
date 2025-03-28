<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    //! Relacion uno a uno inversa
    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
