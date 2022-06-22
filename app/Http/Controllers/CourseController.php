<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use App\Models\Section;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index()
    {
        //
        $data = [
            'title' => 'Skillful Typing | Lesson Editor - Courses',
            'courses' => Course::where('teacher_id', session('user_id'))->get()
        ];

        return view('admin.courses', $data);
    }

    public function view(Request $request, $id)
    {
        //
        $data = [
            'title' => 'Skillful Typing | Lesson Editor - Sections',
            'course_id' => $id,
            'sections' => Section::where('course_id', $id)->get()
        ];

        return view('admin.sections', $data);
    }

    public function create(Request $request)
    {
        //
        $data = [
            'teacher_id' => session('user_id'),
            'course_name' => $request->course_name,
            'course_type' => $request->course_type
        ];
        Course::create($data);
    }

    public function update(Request $request, Course $course)
    {
        //
        $id = $request->course_id;
        $data = [
            'course_name' => $request->course_name
        ];

        Course::where('course_id', $id)->update($data);
    }

    public function delete($id)
    {
        //
        Course::where('course_id', $id)->delete();
        Section::where('course_id', $id)->delete();
        Lesson::where('course_id', $id)->delete();
    }

    public function setting(Request $request)
    {
        $course_id = $request->course_id;
        $data = [
            'course_type' => $request->course_type,
            'min_speed' => $request->min_speed,
            'max_slowdown' => $request->max_slowdown,
            'max_duration' => $request->max_duration,
            'disable_backspace' => $request->disable_backspace,
            'allow_configure' => $request->allow_configure
        ];

        Course::where('course_id', $course_id)->update($data);
        return redirect('/admin/courses');
    }
}
