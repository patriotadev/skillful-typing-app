<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Group;
use App\Models\Lesson;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
{
    //
    public function create(Request $request)
    {

        // $validator = Validator::make($request->all(), [
        //     [
        //         'lesson_file' => 'required|mimes:txt'
        //     ],
        //     [
        //         'lesson_file.required' => 'Please choose lesson file.',
        //         'lesson_file.mimes' => 'File extension should .txt format'
        //     ]
        // ]);

        // if ($validator->fails()) {
        //     $request->session()->flash('lesson_file_validator', 'File extension should .txt format');
        //     return redirect('/admin/courses/' . $request->course_id . '/sections/' . $request->section_id . 'lessons');
        // }

        $file = $request->file('lesson_file');

        $fileExtension = $file->getClientOriginalExtension();

        if ($fileExtension != 'txt') {
            $request->session()->flash('lesson_file_validator', 'Failed! file extension should .txt format');
            return redirect('/admin/courses/' . $request->course_id . '/sections/' . $request->section_id . '/lessons');
        }

        $destinationFolder = storage_path('app/public');
        $fileName = time() . '-' . $file->getClientOriginalName();
        $file->move($destinationFolder, $fileName);

        $data = [
            'teacher_id' => session('user_id'),
            'lesson_name' => $request->lesson_name,
            'lesson_file' => isset($fileName) ? $fileName : '',
            'course_id' => $request->course_id,
            'section_id' => $request->section_id
        ];

        Lesson::create($data);

        $request->session()->flash('lesson_add_success', 'Lesson has been added!');
        return redirect('/admin/courses/' . $request->course_id . '/sections/' . $request->section_id . '/lessons');
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
        return Redirect::back();
    }

    public function delete($id)
    {
        //
        $lesson_file_name = Lesson::where('lesson_id', $id)->pluck('lesson_file')->first();
        unlink(storage_path('app/public/' . $lesson_file_name));
        Lesson::where('lesson_id', $id)->delete();
    }
}
