<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Course;
use App\Models\CurrentLesson;
use App\Models\Section;
use App\Models\Lesson;
use App\Models\Result;
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

        // Get user lesson history

        $userResult = Result::where('user_id', session('user_id'));

        if ($userResult->count() > 0) {
            $last_lesson_id = $userResult->latest()->first()->lesson_id;
            $last_section_id = Lesson::where('lesson_id', $last_lesson_id)->first()->section_id;
            $last_course_id = Lesson::where('lesson_id', $last_lesson_id)->first()->course_id;
            $all_finished_lesson = Result::where('user_id', session('user_id'))->select('lesson_id')->get();

            $data = [
                'title' => 'Skillful Typing | Current Lessons',
                'class' => $class,
                'courses' => $courses->get(),
                'sections' => $sections->get(),
                'lessons' => $lessons,
                'last_lesson_id' => $last_lesson_id,
                'last_section_id' => $last_section_id,
                'last_course_id' => $last_course_id,
                'all_finished_lesson' => $all_finished_lesson
            ];
            return view('student.lessons', $data);
            // return $data;
        }

        $data = [
            'title' => 'Skillful Typing | Current Lessons',
            'class' => $class,
            'courses' => $courses->get(),
            'sections' => $sections->get(),
            'lessons' => $lessons,
            'last_lesson_id' => 0,
            'last_section_id' => 0,
            'last_course_id' => 0,
        ];
        return view('student.lessons', $data);


        // return $data;
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

    public function postStudentCurrentLessonStart(Request $request)
    {
        $lesson_file_name = Lesson::where('lesson_id', $request->lesson)->pluck('lesson_file')->first();
        $lesson_text_from_file = Storage::disk('local')->get('public/' . $lesson_file_name);
        $lesson_text_array = explode(' ', $lesson_text_from_file);

        $lesson_course_id = Lesson::where('lesson_id', $request->lesson)->first()->course_id;
        $course_duration = Course::where('course_id', $lesson_course_id)->first()->max_duration;

        $data = [
            'title' => 'Skillful Typing | Current Lesson',
            'lesson_name' => Lesson::where('lesson_id', $request->lesson)->pluck('lesson_name')->first(),
            'lesson_id' => Lesson::where('lesson_id', $request->lesson)->pluck('lesson_id')->first(),
            'lesson_text' => $lesson_text_array,
            'course_duration' => $course_duration
        ];

        return view('student.lessons_start', $data);
    }

    public function postStudentLessonResult(Request $request)
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
            'type' => 'Lesson'
        ];

        $existResultData = Result::where(['user_id' => session('user_id'), 'lesson_id' => $request->lesson_id])->first();

        if ($existResultData) {
            Result::where(['user_id' => session('user_id'), 'lesson_id' => $request->lesson_id])->update($data);
        } else {
            Result::create($data);
        }
    }

    public function getHomeCurrentLesson()
    {
        $data = [
            'title' => 'Skillful Typing | Current Lessons',
            'courses' => Course::all(),
            'sections' => Section::all(),
            'lessons' => Lesson::all()
        ];

        return view('home.lessons', $data);

        // return $data;
    }

    public function postHomeCurrentLessonStart(Request $request)
    {
        $lesson_file_name = Lesson::where('lesson_id', $request->lesson)->pluck('lesson_file')->first();
        $lesson_text_from_file = Storage::disk('local')->get('public/' . $lesson_file_name);

        $lesson_text_array = explode(' ', $lesson_text_from_file);

        $data = [
            'title' => 'Skillful Typing | Current Lesson',
            'lesson_name' => Lesson::where('lesson_id', $request->lesson)->pluck('lesson_name')->first(),
            'lesson_id' => Lesson::where('lesson_id', $request->lesson)->pluck('lesson_id')->first(),
            'lesson_text' => $lesson_text_array
        ];

        return view('home.lessons_start', $data);
    }
}
