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
            'title' => 'Typing App | Lesson Editor - Courses',
            'courses' => Course::all()
        ];

        return view('admin.courses', $data);
    }

    public function view(Request $request, $id)
    {
        //
        $data = [
            'title' => 'Typing App | Lesson Editor - Sections',
            'course_id' => $id,
            'sections' => Section::where('course_id', $id)->get()
        ];

        return view('admin.sections', $data);
    }

    public function create(Request $request)
    {
        //
        $data = [
            'course_name' => $request->course_name
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
}
