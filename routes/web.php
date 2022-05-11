<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\UserController;
use App\Models\Course;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'index']);
Route::post('/login/post', [AuthController::class, 'login']);

Route::get('/admin/courses', [CourseController::class, 'index']);
Route::get('/admin/courses/{id}/sections', [CourseController::class, 'view']);
Route::post('/admin/courses/add', [CourseController::class, 'create']);
Route::post('/admin/courses/update', [CourseController::class, 'update']);
Route::get('/admin/courses/delete/{id}', [CourseController::class, 'delete']);

Route::get('/admin/courses/{course_id}/sections/{section_id}/lessons', [SectionController::class, 'view']);
Route::post('/admin/sections/add', [SectionController::class, 'create']);
Route::post('/admin/sections/update', [SectionController::class, 'update']);
Route::get('/admin/sections/delete/{id}', [SectionController::class, 'delete']);

Route::post('/admin/lessons/add', [LessonController::class, 'create']);
Route::post('/admin/lessons/update', [LessonController::class, 'update']);
Route::get('/admin/courses/{course_id}/sections/{section_id}/lessons/{lesson_id}', [LessonController::class, 'view']);
Route::get('/admin/lessons/delete/{id}', [LessonController::class, 'delete']);

Route::get('/admin/class', [GroupController::class, 'index']);
Route::get('/admin/class/{id}/students', [GroupController::class, 'view']);
Route::post('/admin/class/add', [GroupController::class, 'create']);
Route::post('/admin/class/update', [GroupController::class, 'update']);
Route::get('/admin/class/delete/{id}', [GroupController::class, 'delete']);

Route::get('/admin/users', [UserController::class, 'index']);
Route::post('/admin/users/add', [UserController::class, 'create']);
Route::post('/admin/users/update', [UserController::class, 'update']);
Route::get('/admin/users/delete/{id}', [UserController::class, 'delete']);

Route::get('/student/lessons', [LessonController::class, 'getStudentCurrentLesson']);
Route::get('/student/lessons/start', [LessonController::class, 'getStudentLessonStart']);
Route::get('/student/tests', [LessonController::class, 'getStudentCurrentTest']);
