<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CurrentLesson;
use App\Models\Group;
use App\Models\Lesson;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Skillful Typing | Users Management',
            'users' => User::all(),
            'class' => Group::all(),
            'class_update' => Group::all(),
        ];

        return view('admin.users', $data);
    }

    public function create(Request $request)
    {
        // User data
        $data = [
            'nim' => $request->nim,
            'fullname' => $request->fullname,
            'class' => $request->class,
            'major' => $request->major,
            'phone' => $request->phone,
            'email' => $request->email,
            'username' => $request->username,
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
            'roles' => $request->roles,
            'status' => $request->status,
            'level' => $request->level,
        ];

        User::create($data);

        // Get current lesson for new user
        // $class = Group::where('class_id', $request->class)->first();
        // $assigned_courses = explode(',', $class->assigned_courses);
        // $sections = Section::where('course_id', $assigned_courses[0])->first;
        // $lessons = Lesson::where('section_id', $sections->section_id)->get();

        // CurrentLesson::create([
        //     'user_id' => $request->nim,
        //     'user_lesson'
        // ])
    }

    public function update(Request $request)
    {
        $data = [
            'nim' => $request->nim,
            'fullname' => $request->fullname,
            'class' => $request->class,
            'major' => $request->major,
            'phone' => $request->phone,
            'email' => $request->email,
            'username' => $request->username,
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
            'roles' => $request->roles,
            'status' => $request->status,
            'level' => $request->level,
        ];
        User::where('user_id', $request->id)->update($data);
    }

    public function delete($id)
    {
        User::where('user_id', $id)->delete();
    }
}
