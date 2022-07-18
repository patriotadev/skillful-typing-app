<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        $request->validate(
            [
                'username' => 'required',
                'password' => 'required'
            ],
            [
                'username.required' => 'Please input your username.',
                'password.required' => 'Please input your password.'
            ]
        );

        $user = User::where('username', $request->username)->first();
        // echo ($user);
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                session([
                    'hasLogin' => true,
                    'user_id' => $user->user_id,
                    'user_username' => $user->username,
                    'user_name' => $user->fullname,
                    'user_nim' => $user->nim,
                    'user_roles' => $user->roles,
                    'user_class' => $user->class
                ]);
                if ($user->roles == 'Admin') {
                    return redirect('/admin/courses');
                }
                return redirect('/guide/typing');
            } else {
                // Password salah
                $request->session()->flash('fail_pass', 'Incorrect Password.');
                return redirect('/login');
            }
        } else {
            // User tidak ditemukan
            $request->session()->flash('fail_user', 'Username not found.');
            return redirect('/login');
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect('/login');
    }
}
