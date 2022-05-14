<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

    protected $table = 'results';
    protected $id = 'result_id';

    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = ['user_id', 'lesson_id', 'wpm', 'accuracy', 'overall_rating', 'type'];
}
