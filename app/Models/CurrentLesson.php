<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrentLesson extends Model
{
    use HasFactory;

    protected $table = 'current_lesson';
    protected $id = 'current_lesson_id';

    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = [
        'user_id',
        'lesson_id',
        'wpm',
        'accuracy',
        'overall_rating',
    ];
}
