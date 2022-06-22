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
        $courses = Course::where('course_type', 'Lesson')->whereIn('course_id', $assigned_courses);
        $sections = Section::whereIn('course_id', $courses->pluck('course_id')->toArray());
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


    public function postStudentCurrentLessonStart(Request $request)
    {
        $lesson_file_name = Lesson::where('lesson_id', $request->lesson)->pluck('lesson_file')->first();
        $lesson_text_from_file = Storage::disk('local')->get('public/' . $lesson_file_name);
        $lesson_text_array = preg_split('/[\s]+/', $lesson_text_from_file);

        $lesson_course_id = Lesson::where('lesson_id', $request->lesson)->first()->course_id;
        $lesson_slowdown = Course::where('course_id', $lesson_course_id)->first()->max_slowdown;

        if ($request->max_duration) {
            $course_duration = $request->max_duration;
        } else {
            $course_duration = Course::where('course_id', $lesson_course_id)->first()->max_duration;
        }

        if ($request->disable_backspace) {
            $course_disable_backspace = $request->disable_backspace;
        } else {
            $course_disable_backspace = Course::where('course_id', $lesson_course_id)->first()->disable_backspace;
        }

        if ($request->max_slowdown) {
            $lesson_slowdown = $request->max_slowdown;
        } else {
            $$lesson_slowdown = Course::where('course_id', $lesson_course_id)->first()->max_slowdown;
        }

        $data = [
            'title' => 'Skillful Typing | Current Lesson',
            'lesson_name' => Lesson::where('lesson_id', $request->lesson)->pluck('lesson_name')->first(),
            'lesson_id' => Lesson::where('lesson_id', $request->lesson)->pluck('lesson_id')->first(),
            'lesson_text' => $lesson_text_array,
            'max_slowdown' => $lesson_slowdown,
            'course_duration' => $course_duration,
            'course_disable_backspace' => $course_disable_backspace
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
            'duration' => $request->duration,
            'correct_words' => $request->correct_words,
            'incorrect_words' => $request->incorrect_words,
            'error_words' => $request->error_words,
            'wpm' => $request->wpm,
            'accuracy' => $request->accuracy,
            'slowdown' => $request->slowdown,
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

        $courses = Course::where('course_type', 'Lesson');
        $sections =  Section::whereIn('course_id', $courses->pluck('course_id')->toArray());
        $lessons = Lesson::whereIn('course_id', $courses->pluck('course_id')->toArray());

        $data = [
            'title' => 'Skillful Typing | Current Lessons',
            'courses' => $courses->get(),
            'sections' => $sections->get(),
            'lessons' => $lessons->get()->take(3)
        ];

        return view('home.lessons', $data);
    }

    public function postHomeCurrentLessonStart(Request $request)
    {
        $lesson_file_name = Lesson::where('lesson_id', $request->lesson)->pluck('lesson_file')->first();
        $lesson_text_from_file = Storage::disk('local')->get('public/' . $lesson_file_name);
        $lesson_text_array = preg_split('/[\s]+/', $lesson_text_from_file);

        $lesson_course_id = Lesson::where('lesson_id', $request->lesson)->first()->course_id;
        $lesson_slowdown = Course::where('course_id', $lesson_course_id)->first()->max_slowdown;

        if ($request->max_duration) {
            $course_duration = $request->max_duration;
        } else {
            $course_duration = Course::where('course_id', $lesson_course_id)->first()->max_duration;
        }

        if ($request->disable_backspace) {
            $course_disable_backspace = $request->disable_backspace;
        } else {
            $course_disable_backspace = Course::where('course_id', $lesson_course_id)->first()->disable_backspace;
        }

        if ($request->max_slowdown) {
            $lesson_slowdown = $request->max_slowdown;
        } else {
            $$lesson_slowdown = Course::where('course_id', $lesson_course_id)->first()->max_slowdown;
        }

        $data = [
            'title' => 'Skillful Typing | Current Lesson',
            'lesson_name' => Lesson::where('lesson_id', $request->lesson)->pluck('lesson_name')->first(),
            'lesson_id' => Lesson::where('lesson_id', $request->lesson)->pluck('lesson_id')->first(),
            'lesson_text' => $lesson_text_array,
            'max_slowdown' => $lesson_slowdown,
            'course_duration' => $course_duration,
            'course_disable_backspace' => $course_disable_backspace
        ];

        return view('home.lessons_start', $data);
    }
}
