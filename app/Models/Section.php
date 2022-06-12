<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;
    protected $table = 'sections';
    protected $id = 'section_id';

    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = ['teacher_id', 'section_name', 'course_id'];
}
