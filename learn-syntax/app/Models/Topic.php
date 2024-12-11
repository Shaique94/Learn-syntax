<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $fillable = [
        'chapter_id',
        'topic_name',
        'order',
        'topic_description',
        'topic_slug',
    ];


    // public function chapter()
    // {
    //     return $this->hasMany(Chapter::class, "id", "chapter_id");
    // }
    public function chapter()
    {
        return $this->belongsTo(Chapter::class);
    }
}
