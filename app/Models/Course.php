<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $table = 'courses';
    protected $id = 'course_id';

    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = [
        'teacher_id',
        'course_name',
        'course_type',
        'min_speed_a',
        'min_accuracy_a',
        'min_speed_b',
        'min_accuracy_b',
        'min_speed_c',
        'min_accuracy_c',
        'max_slowdown',
        'max_duration',
        'disable_backspace',
        'allow_configure',

    ];
}
