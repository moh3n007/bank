<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function userList()
    {
        $users = User::get();
        return view('backend.users.list', ['users'=>$users]);
    }

    public function createForm()
    {
        return view('backend.users.create');
    }

    public function create(Request $request)
    {
        $request->validate(
            [
                'f_name' => 'required',
                'l_name' => 'required',
                'username' => 'required|unique:users|min:5',
                'password' => 'required|min:6|max:20',
                'email' => 'email|nullable',
                'gender' => 'in:male,female',
                'national_code' => 'digits:10|unique:users',
                'phone' => 'required|numeric',
            ],
            [
                'password.min' => 'اسب مساوی است با گاو'
            ]
        );
        $request['password'] = Hash::make($request->password);
        $user = new User($request->all());
        if ($user->save()) {
            return back()->with('alert.success', 'کاربر با موفقیت ثبت گردید');
        }
        return back()->withInput()->with('alert.danger', 'خطا در ثبت اطلاعات');
    }

    public function show(User $user)
    {
        return view('backend.users.show', ['user'=>$user]);
    }
}
