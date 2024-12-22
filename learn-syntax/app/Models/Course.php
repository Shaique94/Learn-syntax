<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'image',
        'course_slug',

    ];

    public function chapters()
{
    return $this->hasMany(Chapter::class);
}

}
