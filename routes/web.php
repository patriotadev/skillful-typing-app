<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\CurrentLessonController;
use App\Http\Controllers\CurrentTestController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentStaticController;
use App\Http\Controllers\UserController;
use App\Http\Middleware\Admin;
use App\Http\Middleware\Authentications;
use App\Http\Middleware\Student;
use App\Models\Course;
use App\Models\CurrentLesson;
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

Route::get('/', [CurrentLessonController::class, 'getHomeCurrentLesson']);
Route::post('/lessons/start', [CurrentLessonController::class, 'postHomeCurrentLessonStart']);
Route::get('/register', [UserController::class, 'registerTeacher']);
Route::post('/register', [UserController::class, 'postRegisterTeacher']);

Route::get('/login', [AuthController::class, 'index']);
Route::post('/login/post', [AuthController::class, 'login']);
Route::get('/about', function () {
    $data = [
        'title' => 'Skillful Typing | About'
    ];

    return view('home.about_us', $data);
});

Route::get('/guide/typing', function () {
    $data = [
        'title' => 'Skillful Typing | Typing Guide'
    ];
    return view('guide.typing_guide', $data);
});

Route::middleware([Authentications::class])->group(function () {
    Route::get('/logout', [AuthController::class, 'logout']);
    Route::get('/profile/{user_id}', [UserController::class, 'editProfile']);
    Route::post('/profile/{user_id}', [UserController::class, 'postEditProfile']);

    Route::middleware([Admin::class])->group(function () {
        Route::get('/admin/courses', [CourseController::class, 'index']);
        Route::get('/admin/courses/{id}/sections', [CourseController::class, 'view']);
        Route::post('/admin/courses/add', [CourseController::class, 'create']);
        Route::post('/admin/courses/update', [CourseController::class, 'update']);
        Route::get('/admin/courses/delete/{id}', [CourseController::class, 'delete']);
        Route::post('/admin/courses/setting', [CourseController::class, 'setting']);

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
        Route::get('/admin/class/{class_id}/students/{student_id}', [GroupController::class, 'getStudentStatic']);
        Route::post('/admin/class/{class_id}/students/{student_id}', [GroupController::class, 'getStudentStaticById']);
        Route::get('/admin/class/{class_id}/students/{student_id}/overall', [GroupController::class, 'studentOverallResult']);
        Route::post('/admin/class/{class_id}/students/{student_id}/overall', [GroupController::class, 'postStudentOverallResult']);
        Route::post('/admin/class/{class_id}/students/{student_id}/overall/pdf', [GroupController::class, 'printToPdf']);

        Route::get('/admin/users', [UserController::class, 'index']);
        Route::post('/admin/users/add', [UserController::class, 'create']);
        Route::post('/admin/users/update', [UserController::class, 'update']);
        Route::get('/admin/users/delete/{id}', [UserController::class, 'delete']);
    });

    Route::middleware([Student::class])->group(function () {
        Route::get('/student/lessons', [CurrentLessonController::class, 'getStudentCurrentLesson']);
        Route::get('/student/lessons/start', [CurrentLessonController::class, 'getStudentLessonStart']);
        Route::post('/student/lessons/start', [CurrentLessonController::class, 'postStudentCurrentLessonStart']);
        Route::post('/student/lessons/result', [CurrentLessonController::class, 'postStudentLessonResult']);


        Route::get('/student/tests', [CurrentTestController::class, 'getStudentCurrentTest']);
        Route::post('/student/tests/start', [CurrentTestController::class, 'postStudentCurrentTestStart']);
        Route::post('/student/tests/result', [CurrentTestController::class, 'postStudentTestResult']);

        Route::get('/student/statics', [StudentStaticController::class, 'index']);
        Route::get('/student/overall', [StudentStaticController::class, 'overallResult']);
        Route::post('/student/overall', [StudentStaticController::class, 'postOverallResult']);

        Route::post('/student/statics', [StudentStaticController::class, 'getLessonStaticById']);
        Route::post('/student/overall/pdf', [StudentStaticController::class, 'printToPdf']);
        Route::get('/student/statics/{lesson_id}', [StudentStaticController::class, 'getLessonStaticPageById']);
    });
});
