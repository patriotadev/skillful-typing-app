<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $table = 'lessons';
    protected $id = 'lesson_id';

    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = ['lesson_name', 'lesson_file', 'course_id', 'section_id'];
}
