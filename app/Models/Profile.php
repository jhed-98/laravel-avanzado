<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $guarded = ['id', 'created_at', 'updated_at'];

    //! Relacion uno a uno inversa
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    //! Relacion uno a uno
    public function address()
    {
        return $this->hasOne(Address::class);
    }
}
