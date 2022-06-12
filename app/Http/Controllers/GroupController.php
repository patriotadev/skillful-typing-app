<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Group;
use App\Models\Lesson;
use App\Models\Result;
use App\Models\Section;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    public function index()
    {
        //

        $data = [
            'title' => 'Skillful Typing | Student Static - Class',
            'class' => Group::where('teacher_id', session('user_id'))->get(),
            'courses' => Course::where('teacher_id', session('user_id'))->get()
        ];

        return view('admin.class', $data);
    }

    public function view($id)
    {
        $data = [
            'title' => 'Skillful Typing | Student Static - Students',
            'class_id' => $id,
            'students' => User::where(['roles' => 'Student', 'class' => $id])->get()
        ];

        return view('admin.students', $data);
    }

    public function create(Request $request)
    {
        $courses_id = $request->assigned_courses;
        $courses_id_implode = implode(', ', $courses_id);
        $data = [
            'teacher_id' => session('user_id'),
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

    public function getStudentStatic($class_id, $student_id)
    {
        $class = Group::where('class_id', $class_id)->first();
        $assigned_courses = explode(',', $class->assigned_courses);
        $courses = Course::whereIn('course_id', $assigned_courses);
        $sections = Section::whereIn('course_id', $assigned_courses);
        $lessons = Lesson::whereIn('section_id', $sections->pluck('section_id'))->get();

        // Get user lesson history

        $userResult = Result::where('user_id', $student_id);

        if ($userResult->count() > 0) {
            $last_lesson_id = $userResult->latest()->first()->lesson_id;
            $last_section_id = Lesson::where('lesson_id', $last_lesson_id)->first()->section_id;
            $last_course_id = Lesson::where('lesson_id', $last_lesson_id)->first()->course_id;
            $all_finished_lesson = Result::where('user_id', $student_id)->select('lesson_id')->get();

            $data = [
                'title' => 'Skillful Typing | Student Static',
                'class' => $class,
                'courses' => $courses->get(),
                'sections' => $sections->get(),
                'lessons' => $lessons,
                'last_lesson_id' => $last_lesson_id,
                'last_section_id' => $last_section_id,
                'last_course_id' => $last_course_id,
                'all_finished_lesson' => $all_finished_lesson,
                'student_id' => $student_id,
                'class_id' => $class_id
            ];

            return view('admin.student_static', $data);
        }

        $data = [
            'title' => 'Skillful Typing | Student Static',
            'class' => $class,
            'courses' => $courses->get(),
            'sections' => $sections->get(),
            'lessons' => $lessons,
            'student_id' => $student_id,
            'class_id' => $class_id
        ];

        return view('admin.student_static', $data);
    }


    public function getStudentStaticById(Request $request)
    {
        $result = Result::where(['user_id' => $request->student_id, 'lesson_id' => $request->lesson])->first();

        // 
        $class = Group::where('class_id', $request->class_id)->first();
        $assigned_courses = explode(',', $class->assigned_courses);
        $courses = Course::whereIn('course_id', $assigned_courses);
        $sections = Section::whereIn('course_id', $assigned_courses);
        $lessons = Lesson::whereIn('section_id', $sections->pluck('section_id'))->get();

        $userResult = Result::where('user_id', $request->student_id);

        if ($userResult->count() > 0) {
            $data = [
                'title' => 'Skillful Typing | Student Static',
                'class' => $class,
                'courses' => $courses->get(),
                'sections' => $sections->get(),
                'lessons' => $lessons,
                'result' => $result,
                'student_id' => $request->student_id,
                'class_id' => $request->class_id
                // 'message' => 'Lesson result not found.'
            ];

            return view('admin.student_static', $data);
        }

        $data = [
            'title' => 'Skillful Typing | Student Static',
            'class' => $class,
            'courses' => $courses->get(),
            'sections' => $sections->get(),
            'lessons' => $lessons,
            'student_id' => $request->student_id,
            'class_id' => $request->class_id,
            'message' => 'Lesson result not found.'
        ];

        return view('admin.student_static', $data);
    }

    public function studentOverallResult($class_id, $student_id)
    {
        $class = Group::where('class_id', $class_id)->first();
        $assigned_courses = explode(',', $class->assigned_courses);
        $courses = Course::whereIn('course_id', $assigned_courses);

        $data = [
            'title' => 'Skillful Typing | Student Static - Overall Result',
            'courses' => $courses->get(),
            'class_id' => $class_id,
            'student_id' => $student_id
        ];

        return view('admin.overall_result', $data);
    }

    public function postStudentOverallResult($class_id, $student_id, Request $request)
    {
        $class = Group::where('class_id', $class_id)->first();
        $assigned_courses = explode(',', $class->assigned_courses);
        $courses = Course::whereIn('course_id', $assigned_courses);

        $sections = Section::where('course_id', $request->course_id);
        $lessons = Lesson::where('course_id', $request->course_id);

        $selectedCourse = Course::where('course_id', $request->course_id)->first();
        $lessons_name =  $lessons->pluck('lesson_name')->toArray();
        $lessons_id =  $lessons->pluck('lesson_id')->toArray();
        $lessons_completed = Result::where('user_id', $student_id)->whereIn('lesson_id', $lessons_id)->pluck('lesson_id')->count();
        $sum_speed = Result::where('user_id', $student_id)->whereIn('lesson_id', $lessons_id)->sum('wpm');
        $sum_accuracy = Result::where('user_id', $student_id)->whereIn('lesson_id', $lessons_id)->sum('accuracy');
        $error_words = Result::where('user_id', $student_id)->whereIn('lesson_id', $lessons_id)->sum('incorrect_words');
        $correct_words = Result::where('user_id', $student_id)->whereIn('lesson_id', $lessons_id)->sum('correct_words');
        $time_spend = Result::where('user_id', $student_id)->whereIn('lesson_id', $lessons_id)->sum('minutes');

        $data = [
            'title' => 'Skillful Typing | Student Static - Overall Result',
            'courses' => $courses->get(),
            'lessons_name' => implode(', ', $lessons_name),
            'lessons_count' => $lessons->count(),
            'sections_name' => $sections->get(),
            'selected_course' => $selectedCourse,
            'lessons_completed' => $lessons_completed,
            'avg_speed' => $sum_speed / $lessons_completed,
            'avg_accuracy' => $sum_accuracy / $lessons_completed,
            'error_words' => $error_words,
            'time_spend' => number_format((float)$time_spend, 2, '.', ''),
            'words_typed' => $correct_words + $error_words,
            'class_id' => $class_id,
            'student_id' => $student_id
        ];

        return view('admin.overall_result', $data);
    }

    public function printToPdf($class_id, $student_id, Request $request)
    {
        $class = Group::where('class_id', $class_id)->first();
        $assigned_courses = explode(',', $class->assigned_courses);
        $courses = Course::whereIn('course_id', $assigned_courses);

        $sections = Section::where('course_id', $request->course_id);
        $lessons = Lesson::where('course_id', $request->course_id);

        $selectedCourse = Course::where('course_id', $request->course_id)->first();
        $lessons_name =  $lessons->pluck('lesson_name')->toArray();
        $lessons_id =  $lessons->pluck('lesson_id')->toArray();
        $lessons_completed = Result::where('user_id', $student_id)->whereIn('lesson_id', $lessons_id)->pluck('lesson_id')->count();
        $sum_speed = Result::where('user_id', $student_id)->whereIn('lesson_id', $lessons_id)->sum('wpm');
        $sum_accuracy = Result::where('user_id', $student_id)->whereIn('lesson_id', $lessons_id)->sum('accuracy');
        $error_words = Result::where('user_id', $student_id)->whereIn('lesson_id', $lessons_id)->sum('incorrect_words');
        $correct_words = Result::where('user_id', $student_id)->whereIn('lesson_id', $lessons_id)->sum('correct_words');
        $time_spend = Result::where('user_id', $student_id)->whereIn('lesson_id', $lessons_id)->sum('minutes');
        $student_name = User::where('user_id', $student_id)->first()->fullname;
        $student_nim = User::where('user_id', $student_id)->first()->nim;
        $student_class_name = Group::where('class_id', $class_id)->first()->class_name;

        $data = [
            'title' => 'Skillful Typing | Student Static - Overall Result',
            'courses' => $courses->get(),
            'lessons_name' => implode(', ', $lessons_name),
            'lessons_count' => $lessons->count(),
            'sections_name' => $sections->get(),
            'selected_course' => $selectedCourse,
            'lessons_completed' => $lessons_completed,
            'avg_speed' => $sum_speed / $lessons_completed,
            'avg_accuracy' => $sum_accuracy / $lessons_completed,
            'error_words' => $error_words,
            'time_spend' => number_format((float)$time_spend, 2, '.', ''),
            'words_typed' => $correct_words + $error_words,
            'user_class' => Group::where('class_id', $class_id)->first()->class_name,
            'student_name' => $student_name,
            'student_nim' => $student_nim,
            'student_class' => $student_class_name
        ];

        // // return view('student.overall_result', $data);
        $pdf = PDF::loadView('admin.overall_result_print', $data)->setPaper('A4', 'landscape')->setOptions([
            'dpi' => 150,
            'defaultFont' => 'sans-serif',
            'enable-javascript' => true,
            'javascript-delay' => 13000,
            'images' => true,
            'enable-smart-shrinking' => true,
            'no-stop-slow-scripts' => true
        ]);

        return $pdf->download($student_name . '_' . $selectedCourse->course_name);
    }
}
