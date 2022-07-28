<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CurrentLesson;
use App\Models\Group;
use App\Models\Lesson;
use App\Models\Section;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Skillful Typing | Users Management',
            'users' => User::where(['roles' => 'Student', 'teacher_id' => session('user_id')])->get(),
            'class' => Group::where('teacher_id', session('user_id'))->get(),
            'class_update' => Group::where('teacher_id', session('user_id'))->get(),
        ];

        return view('admin.users', $data);
    }

    public function create(Request $request)
    {
        // User data

        $request->validate(
            [
                'username' => 'required|unique:users,username'
            ]
        );

        $data = [
            'teacher_id' => session('user_id'),
            'nim' => $request->nim,
            'fullname' => $request->fullname,
            'class' => $request->class,
            'major' => $request->major,
            'phone' => $request->phone,
            'email' => $request->email,
            'username' => $request->username,
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
            'plain_password' => $request->password,
            'roles' => $request->roles,
            'status' => $request->status,
        ];

        User::create($data);
        return Redirect::back();
    }

    public function update(Request $request)
    {
        $request->validate(
            [
                'username' => 'required|unique:users,username,' . $request->id . ',user_id'
            ]
        );

        $data = [
            'nim' => $request->nim,
            'fullname' => $request->fullname,
            'class' => $request->class,
            'major' => $request->major,
            'phone' => $request->phone,
            'email' => $request->email,
            'username' => $request->username,
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
            'plain_password' => $request->password,
            'roles' => $request->roles,
            'status' => $request->status,
        ];
        User::where('user_id', $request->id)->update($data);
        return Redirect::back();
    }

    public function delete($id)
    {
        User::where('user_id', $id)->delete();
    }


    public function registerTeacher()
    {
        $data = [
            'title' => 'Skillful Ttyping | Register as a Teacher'
        ];

        return view('home.register', $data);
    }

    public function postRegisterTeacher(Request $request)
    {

        $request->validate(
            [
                'fullname' => 'required',
                'birth' => 'required',
                'gender' => 'required',
                'city' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'username' => 'required|unique:users,username',
                'password' => 'required',
                'confirm_pass' => 'required|same:password',
                'status' => 'required',
            ],
            [
                'fullname.required' => 'Please input username field.',
                'birth.required' => 'Please input birth field.',
                'gender.required' => 'Please input gender field.',
                'city.required' => 'Please input city field.',
                'phone.required' => 'Please input phone field.',
                'email.required' => 'Please input email field.',
                'username.required' => 'Please input username field.',
                'username.unique' => 'Username has already taken.',
                'password.required' => 'Please input password field.',
                'confirm_pass.required' => 'Please input confirm password field.',
                'confirm_pass.same' => 'Confirmation password isn\'t match with password',
                'status.required' => 'Please input status field.',
            ]
        );


        $data = [
            'nim' => '-',
            'fullname' => $request->fullname,
            'class' => '-',
            'major' => '-',
            // 'birth' => $request->birth,
            // 'gender' => $request->gender,
            // 'city' => $request->city,
            'phone' => $request->phone,
            'email' => $request->email,
            'username' => $request->username,
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
            'plain_password' => $request->password,
            'roles' => 'Admin',
            'status' => $request->status,
        ];

        User::create($data);
        $request->session()->flash('add_teacher_success', 'Teacher has been added!');
        return redirect('/login');
    }


    public function editProfile($user_id)
    {

        $user = User::where('user_id', $user_id)->first();

        if (session('user_roles') == 'Admin') {
            $data = [
                'title' => 'Skillful Typing | Profile',
                'user_id' => $user->user_id,
                'fullname' => $user->fullname,
                'phone' => $user->phone,
                'email' => $user->email,
                'username' => $user->username,
                'password' => $user->password,
                'plain_password' => $user->plain_password,
                'status' => $user->status,
                'status' => $user->status,

            ];
            return view('admin.edit_profile', $data);
        }

        $data = [
            'title' => 'Skillful Typing | Profile',
            'user_id' => $user->user_id,
            'nim' => $user->nim,
            'fullname' => $user->fullname,
            'student_class' => Group::where('class_id', $user->class)->first()->class_name,
            'major' => $user->major,
            'phone' => $user->phone,
            'email' => $user->email,
            'username' => $user->username,
            'password' => $user->password,
            'plain_password' => $user->plain_password,
            'status' => $user->status,
            'status' => $user->status,
        ];
        return view('student.edit_profile', $data);
    }

    public function postEditProfile($user_id, Request $request)
    {

        if (session('user_roles') == 'Admin') {
            $request->validate(
                [
                    'fullname' => 'required',
                    'phone' => 'required',
                    'email' => 'required',
                    'username' => 'required|unique:users,username,' . $user_id . ',user_id',
                    'confirm_new_password' => 'same:password',
                    'status' => 'required',
                ],
                [
                    'fullname.required' => 'Please input username field.',
                    'phone.required' => 'Please input phone field.',
                    'email.required' => 'Please input email field.',
                    'username.required' => 'Please input username field.',
                    'username.unique' => 'Username has already taken.',
                    'confirm_new_password.same' => 'New password isn\'t match with password',
                    'status.required' => 'Please input status field.',
                ]
            );

            $oldPass = User::where('user_id', $user_id)->first()->password;
            $data = [
                'fullname' => $request->fullname,
                'phone' => $request->phone,
                'email' => $request->email,
                'username' => $request->username,
                'password' => $request->password != null ? password_hash($request->confirm_new_password, PASSWORD_DEFAULT) : $oldPass,
                'plain_password' => $request->password != null ? $request->password : User::where('user_id', $user_id)->first()->plain_password,
                'status' => $request->status,
            ];
        }

        if (session('user_roles') == 'Student') {
            $request->validate(
                [
                    'nim' => 'required',
                    'fullname' => 'required',
                    'phone' => 'required',
                    'email' => 'required',
                    'username' => 'required|unique:users,username,' . $user_id . ',user_id',
                    'confirm_new_password' => 'same:password',
                    'status' => 'required',
                ],
                [
                    'nim.required' => 'Please input nim field',
                    'fullname.required' => 'Please input username field.',
                    'phone.required' => 'Please input phone field.',
                    'email.required' => 'Please input email field.',
                    'username.required' => 'Please input username field.',
                    'username.unique' => 'Username has already taken.',
                    'confirm_new_password.same' => 'New password isn\'t match with password',
                    'status.required' => 'Please input status field.',
                ]
            );

            $oldPass = User::where('user_id', $user_id)->first()->password;
            $data = [
                'nim' => $request->nim,
                'fullname' => $request->fullname,
                'phone' => $request->phone,
                'email' => $request->email,
                'username' => $request->username,
                'password' => $request->password != null ? password_hash($request->confirm_new_password, PASSWORD_DEFAULT) : $oldPass,
                'plain_password' => $request->password != null ? $request->password : User::where('user_id', $user_id)->first()->plain_password,
                'status' => $request->status,
            ];
        }

        User::where('user_id', $user_id)->update($data);
        $request->session()->flash('edit_profile_success', 'Profile has been updated!');
        return redirect('/profile/' . $user_id);
    }
}
