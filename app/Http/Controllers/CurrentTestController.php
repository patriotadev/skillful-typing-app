<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Group;
use App\Models\Lesson;
use App\Models\Section;
use App\Models\Result;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CurrentTestController extends Controller
{
    //
    public function getStudentCurrentTest()
    {
        $class = Group::where('class_id', session('user_class'))->first();
        $assigned_courses = explode(',', $class->assigned_courses);
        $courses = Course::where('course_type', 'Test')->whereIn('course_id', $assigned_courses);
        $sections = Section::whereIn('course_id', $courses->pluck('course_id')->toArray());
        $lessons = Lesson::whereIn('section_id', $sections->pluck('section_id'));

        // Get user test history
        $userResult = Result::where('user_id', session('user_id'))->whereIn('lesson_id', $lessons->pluck('lesson_id'));

        if ($userResult->count() > 0) {
            $last_lesson_id = $userResult->latest()->first()->lesson_id;
            $last_section_id = Lesson::where('lesson_id', $last_lesson_id)->first()->section_id;
            $last_course_id = Lesson::where('lesson_id', $last_lesson_id)->first()->course_id;
            $all_finished_lesson = Result::where('user_id', session('user_id'))->whereIn('lesson_id', $lessons->pluck('lesson_id'))->select('lesson_id')->get();

            $data = [
                'title' => 'Skillful Typing | Current Test',
                'class' => $class,
                'courses' => $courses->get(),
                'sections' => $sections->get(),
                'lessons' => $lessons->get(),
                'last_lesson_id' => $last_lesson_id,
                'last_section_id' => $last_section_id,
                'last_course_id' => $last_course_id,
                'all_finished_lesson' => $all_finished_lesson
            ];

            return view('student.test', $data);
        }

        $data = [
            'title' => 'Skillful Typing | Current Test',
            'class' => $class,
            'courses' => $courses->get(),
            'sections' => $sections->get(),
            'lessons' => $lessons->get(),
            'last_lesson_id' => 0,
            'last_section_id' => 0,
            'last_course_id' => 0,
        ];
        return view('student.test', $data);
    }

    public function postStudentCurrentTestStart(Request $request)
    {
        $lesson_file_name = Lesson::where('lesson_id', $request->lesson)->pluck('lesson_file')->first();
        $lesson_text_from_file = Storage::disk('local')->get('public/' . $lesson_file_name);
        $lesson_text_array = explode(' ', $lesson_text_from_file);

        $lesson_course_id = Lesson::where('lesson_id', $request->lesson)->first()->course_id;
        $course_duration = Course::where('course_id', $lesson_course_id)->first()->max_duration;
        $course_disable_backspace = Course::where('course_id', $lesson_course_id)->first()->disable_backspace;

        $data = [
            'title' => 'Skillful Typing | Current Lesson',
            'lesson_name' => Lesson::where('lesson_id', $request->lesson)->pluck('lesson_name')->first(),
            'lesson_id' => Lesson::where('lesson_id', $request->lesson)->pluck('lesson_id')->first(),
            'lesson_text' => $lesson_text_array,
            'course_duration' => $course_duration,
            'course_disable_backspace' => $course_disable_backspace
        ];

        return view('student.test_start', $data);
        // return $data;
    }

    public function postStudentTestResult(Request $request)
    {
        $data = [
            'user_id' => session('user_id'),
            'lesson_id' => $request->lesson_id,
            'total_words' => $request->total_words,
            'minutes' => $request->minutes,
            'correct_words' => $request->correct_words,
            'incorrect_words' => $request->incorrect_words,
            'wpm' => $request->wpm,
            'accuracy' => $request->accuracy,
            'overall_rating' => $request->overall_rating,
            'type' => 'Test'
        ];

        $existResultData = Result::where(['user_id' => session('user_id'), 'lesson_id' => $request->lesson_id])->first();

        if ($existResultData) {
            Result::where(['user_id' => session('user_id'), 'lesson_id' => $request->lesson_id])->update($data);
        } else {
            Result::create($data);
        }
    }
}
