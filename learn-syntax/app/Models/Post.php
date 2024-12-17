<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function topic(){
        return $this->belongsTo(Topic::class);
    }
}
