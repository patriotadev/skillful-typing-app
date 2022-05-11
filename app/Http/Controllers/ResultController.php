<?php

namespace App\Http\Controllers;

use App\Models\Result;
use Illuminate\Http\Request;

class ResultController extends Controller
{

    public function index()
    {
        //
    }

    public function create()
    {
        $data = [
            'user_id' => session('user_id')
        ];
    }
}
