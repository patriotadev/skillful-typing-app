<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory;

    protected $table = 'users';
    protected $id = 'user_id';

    protected $dates = ['created_at', 'updated_at'];

    protected $fillable = [
        'nim',
        'teacher_id',
        'fullname',
        'class',
        'major',
        'phone',
        'email',
        'username',
        'password',
        'roles',
        'status',
    ];
}
