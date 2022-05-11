<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = 'groups';
    protected $id = 'class_id';

    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = ['class_name', 'assigned_courses'];
}
