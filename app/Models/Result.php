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

    protected $fillable = ['user_id', 'course_id', 'section_id', 'lessons'];
}
