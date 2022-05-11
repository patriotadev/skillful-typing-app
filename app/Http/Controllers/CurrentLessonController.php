<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Course;
use App\Models\CurrentLesson;
use App\Models\Section;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CurrentLessonController extends Controller
{
    //
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

    public function postStudentCurrentLessonStart(Request $request)
    {
        // $course = Course::where('course_id', $request->course)->first();
        // $section = Section::where(['section_id' => $request->section, 'course_id', $request->course])->first();
        $lesson_file_name = Lesson::where('lesson_id', $request->lesson)->pluck('lesson_file')->first();
        $lesson_text_from_file = Storage::disk('local')->get('public/' . $lesson_file_name);

        $lesson_text_array = explode(' ', $lesson_text_from_file);

        $data = [
            'title' => 'Skillful Typing | Current Lesson',
            'lesson_name' => Lesson::where('lesson_id', $request->lesson)->pluck('lesson_name')->first(),
            'lesson_id' => Lesson::where('lesson_id', $request->lesson)->pluck('lesson_id')->first(),
            'lesson_text' => $lesson_text_array
        ];

        return view('student.lessons_start', $data);
    }
}
