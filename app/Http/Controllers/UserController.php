<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Typing App | Users Management',
            'users' => User::all(),
            'class' => Group::all(),
            'class_update' => Group::all(),
        ];

        return view('admin.users', $data);
    }

    public function create(Request $request)
    {
        $data = [
            'nim' => $request->nim,
            'fullname' => $request->fullname,
            'class' => $request->class,
            'major' => $request->major,
            'phone' => $request->phone,
            'email' => $request->email,
            'username' => $request->username,
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
            'roles' => $request->roles,
            'status' => $request->status,
            'level' => $request->level,
        ];
        User::create($data);
    }

    public function update(Request $request)
    {
        $data = [
            'nim' => $request->nim,
            'fullname' => $request->fullname,
            'class' => $request->class,
            'major' => $request->major,
            'phone' => $request->phone,
            'email' => $request->email,
            'username' => $request->username,
            'password' => password_hash($request->password, PASSWORD_DEFAULT),
            'roles' => $request->roles,
            'status' => $request->status,
            'level' => $request->level,
        ];
        User::where('user_id', $request->id)->update($data);
    }

    public function delete($id)
    {
        User::where('user_id', $id)->delete();
    }
}
