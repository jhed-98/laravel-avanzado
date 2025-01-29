<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /** @use HasFactory<\Database\Factories\CourseFactory> */
    use HasFactory;

    protected $fillable = ['title'];

    //! Relacion de uno a muchos
    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    //! Relacion uno a muchos a traves de
    public function lessons()
    {
        return $this->hasManyThrough(Lesson::class, Section::class);
    }
}
