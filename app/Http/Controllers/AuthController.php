<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $user = User::where('username', $request->username)->first();

        // echo ($user);
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                session([
                    'hasLogin' => true,
                    'user_id' => $user->user_id,
                    'user_username' => $user->username,
                    'user_name' => $user->fullname,
                    'user_roles' => $user->roles,
                    'user_class' => $user->class
                ]);
                if ($user->roles == 'Admin') {
                    return redirect('/admin/courses');
                }
                return redirect('/student/lessons');
            } else {
                // Password salah
                return redirect('/login');
            }
        } else {
            // User tidak ditemukan
            return redirect('/login');
        }
    }
}
