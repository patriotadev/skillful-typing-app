<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StudentStaticController extends Controller
{
    //

    public function index()
    {
        $data = [
            'title' => 'Skillfull Typing | Student Static'
        ];

        return view('student.student_static', $data);
    }

    public function overall_result()
    {
        $data = [
            'title' => 'Skillful Typing | Student Static - Overall Result'
        ];

        return view('student.overall_result', $data);
    }
}
