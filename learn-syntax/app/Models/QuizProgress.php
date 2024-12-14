<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizProgress extends Model
{
protected $fillable = [

    'question',
    'options',
    'correct_option',
    'chapter_id'

];
}
