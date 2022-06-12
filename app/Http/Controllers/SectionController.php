<?php

namespace App\Http\Controllers;

use App\Models\Lesson;
use App\Models\Section;
use Illuminate\Http\Request;

class SectionController extends Controller
{
    //

    public function view($course_id, $section_id)
    {
        $data = [
            'title' => 'Skillful Typing | Lesson Editor - Lessons',
            'course_id' => $course_id,
            'section_id' => $section_id,
            'lessons' => Lesson::where(['course_id' => $course_id, 'section_id' => $section_id])->get()
        ];

        return view('admin.lessons', $data);
    }

    public function create(Request $request)
    {
        //
        $data = [
            'teacher_id' => session('user_id'),
            'section_name' => $request->section_name,
            'course_id' => $request->course_id
        ];
        Section::create($data);
    }

    public function update(Request $request)
    {
        $id = $request->section_id;
        $data = [
            'section_name' => $request->section_name
        ];

        Section::where('section_id', $id)->update($data);
    }

    public function delete($id)
    {
        //
        Section::where('section_id', $id)->delete();
        Lesson::where('section_id', $id)->delete();
    }
}
