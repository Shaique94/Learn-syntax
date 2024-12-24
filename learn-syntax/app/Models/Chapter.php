<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chapter extends Model
{
    use HasFactory;
    public function courses()
    {
        return $this->belongsTo(course::class);
    }

    protected $fillable = [
        'course_id',
        'chapter_name',
        'chapter_description',
        'chapter_slug',
        'order'

    ];

    // public function course()
    // {
    //     return $this->hasMany(Course::class, "id", "course_id");
    // }
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }
}
