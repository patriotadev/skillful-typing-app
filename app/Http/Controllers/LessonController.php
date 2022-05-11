<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Group;
use App\Models\Lesson;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    //
    public function create(Request $request)
    {
        $file = $request->file('lesson_file');
        $destinationFolder = storage_path('app/public');
        $fileName = time() . '-' . $file->getClientOriginalName();
        $file->move($destinationFolder, $fileName);

        $data = [
            'lesson_name' => $request->lesson_name,
            'lesson_file' => isset($fileName) ? $fileName : '',
            'course_id' => $request->course_id,
            'section_id' => $request->section_id
        ];

        Lesson::create($data);
    }

    public function view($course_id, $section_id, $lesson_id)
    {
        $lesson_file_name = Lesson::where('lesson_id', $lesson_id)->pluck('lesson_file')->first();
        $lesson_name = Lesson::where('lesson_id', $lesson_id)->pluck('lesson_name')->first();
        $lesson_id = Lesson::where('lesson_id', $lesson_id)->pluck('lesson_id')->first();
        $data = [
            'title' => 'Skillful Typing | Lesson Editor - Lessons',
            'text' => Storage::disk('local')->get('public/' . $lesson_file_name),
            'lesson_name' => $lesson_name,
            'lesson_id' => $lesson_id,
            'course_id' => $course_id,
            'section_id' => $section_id
        ];
        return view('admin.text', $data);
    }

    public function update(Request $request)
    {
        $id = $request->lesson_id;
        $lesson_file_name = Lesson::where('lesson_id', $id)->pluck('lesson_file')->first();
        $data = [
            'lesson_name' => $request->lesson_name
        ];

        Storage::put('public/' . $lesson_file_name, $request->lesson_text);
        Lesson::where('lesson_id', $id)->update($data);
    }

    public function delete($id)
    {
        //
        $lesson_file_name = Lesson::where('lesson_id', $id)->pluck('lesson_file')->first();
        unlink(storage_path('app/public/' . $lesson_file_name));
        Lesson::where('lesson_id', $id)->delete();
    }

    public function getStudentCurrentLesson()
    {
        $class = Group::where('class_id', session('user_class'))->first();
        $assigned_courses = explode(',', $class->assigned_courses);
        $courses = Course::whereIn('course_id', $assigned_courses);
        $sections = Section::whereIn('course_id', $assigned_courses);
        $lessons = Lesson::whereIn('section_id', $sections->pluck('section_id'))->get();

        $data = [
            'title' => 'Skillful Typing | Current Lessons',
            'class' => $class,
            'courses' => $courses->get(),
            'sections' => $sections->get(),
            'lessons' => $lessons
        ];

        return view('student.lessons', $data);
    }

    public function getStudentCurrentTest()
    {
        $class = Group::where('class_id', session('user_class'))->first();
        $assigned_courses = explode(',', $class->assigned_courses);
        $courses = Course::whereIn('course_id', $assigned_courses);
        $sections = Section::whereIn('course_id', $assigned_courses);
        $lessons = Lesson::whereIn('section_id', $sections->pluck('section_id'))->get();

        $data = [
            'title' => 'Skillful Typing | Current Test',
            'class' => $class,
            'courses' => $courses->get(),
            'sections' => $sections->get(),
            'lessons' => $lessons
        ];

        return view('student.test', $data);
    }

    public function getStudentLessonStart()
    {
        $data = [
            'title' => 'Skillful Typing | Current Lesson'
        ];

        return view('student.lessons_start', $data);
    }
}
