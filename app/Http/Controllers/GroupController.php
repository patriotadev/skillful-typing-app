<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        //

        $data = [
            'title' => 'Typing App | Student Static - Class',
            'class' => Group::all(),
            'courses' => Course::all()
        ];

        return view('admin.class', $data);
    }

    public function view($id)
    {
        $data = [
            'title' => 'Typing App | Student Static - Students',
            'students' => User::where(['roles' => 'Student', 'class' => $id])->get()
        ];

        return view('admin.students', $data);
    }

    public function create(Request $request)
    {
        $courses_id = $request->assigned_courses;
        $courses_id_implode = implode(', ', $courses_id);
        $data = [
            'class_name' => $request->class_name,
            'assigned_courses' => $courses_id_implode
        ];

        Group::create($data);
    }

    public function update(Request $request)
    {
        //
        $id = $request->class_id;
        $courses_id = $request->assigned_courses;
        $courses_id_implode = implode(', ', $courses_id);
        $data = [
            'class_name' => $request->class_name,
            'assigned_courses' => $courses_id_implode
        ];

        Group::where('class_id', $id)->update($data);
    }

    public function delete($id)
    {
        //
        Group::where('class_id', $id)->delete();
    }
}
