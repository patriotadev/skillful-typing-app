<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Group;
use App\Models\Lesson;
use App\Models\Result;
use App\Models\Section;
use Illuminate\Http\Request;

class StudentStaticController extends Controller
{
    //

    public function index()
    {

        $class = Group::where('class_id', session('user_class'))->first();
        $assigned_courses = explode(',', $class->assigned_courses);
        $courses = Course::whereIn('course_id', $assigned_courses);
        $sections = Section::whereIn('course_id', $assigned_courses);
        $lessons = Lesson::whereIn('section_id', $sections->pluck('section_id'))->get();

        // Get user lesson history

        $userResult = Result::where('user_id', session('user_id'));

        if ($userResult->count() > 0) {
            $last_lesson_id = $userResult->latest()->first()->lesson_id;
            $last_section_id = Lesson::where('lesson_id', $last_lesson_id)->first()->section_id;
            $last_course_id = Lesson::where('lesson_id', $last_lesson_id)->first()->course_id;
            $all_finished_lesson = Result::where('user_id', session('user_id'))->select('lesson_id')->get();

            $data = [
                'title' => 'Skillful Typing | Student Static',
                'class' => $class,
                'courses' => $courses->get(),
                'sections' => $sections->get(),
                'lessons' => $lessons,
                'last_lesson_id' => $last_lesson_id,
                'last_section_id' => $last_section_id,
                'last_course_id' => $last_course_id,
                'all_finished_lesson' => $all_finished_lesson
            ];

            return view('student.student_static', $data);
        }
    }

    public function overall_result()
    {
        $data = [
            'title' => 'Skillful Typing | Student Static - Overall Result'
        ];

        return view('student.overall_result', $data);
    }

    public function getLessonStaticById(Request $request)
    {
        $result = Result::where(['user_id' => session('user_id'), 'lesson_id' => $request->lesson])->first();

        // 
        $class = Group::where('class_id', session('user_class'))->first();
        $assigned_courses = explode(',', $class->assigned_courses);
        $courses = Course::whereIn('course_id', $assigned_courses);
        $sections = Section::whereIn('course_id', $assigned_courses);
        $lessons = Lesson::whereIn('section_id', $sections->pluck('section_id'))->get();

        $userResult = Result::where('user_id', session('user_id'));

        $data = [
            'title' => 'Skillful Typing | Student Static',
        ];

        if ($userResult->count() > 0) {
            $data = [
                'title' => 'Skillful Typing | Student Static',
                'class' => $class,
                'courses' => $courses->get(),
                'sections' => $sections->get(),
                'lessons' => $lessons,
                'result' => $result
            ];

            return view('student.student_static', $data);
        }
    }
}
