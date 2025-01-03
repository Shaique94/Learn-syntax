<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{


    use HasFactory;
    protected $fillable = [
        'topic_id',
        'title',
        'content',
        'image_path',
        'status'
       

    ];

    public function topic(){
        return $this->belongsTo(Topic::class);
    }
}
