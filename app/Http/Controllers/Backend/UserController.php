<?php

namespace App\Http\Controllers\Backend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;

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
                'f_name.required' => 'وارد کردن نام الزامی می باشد',
                'l_name.required' => 'وارد کردن نام خانوادگی الزامی می باشد',
                'username.required' => 'وارد کردن نام کاربری الزامی می باشد',
                'username.unique' => 'قبلا از این نام استفاده شده است',
                'username.min' => 'نام کاربری باید حداقل 5 کاراکتر باشد',
                'password.required' => 'وارد کردن رمز عبور کاربری الزامی می باشد',
                'password.min' => 'رمز عبور باید حداقل 6 کاراکتر باشد',
                'password.max' => 'رمز عبور نباید بیشتر از 20 کاراکتر باشد',
                'email.email' => 'پست الکترونیکی وارد شده صحیح نمی باشد',
                'national_code.digits' => 'تعداد رقم کد ملی باید 10 رقم باشد',
                'national_code.unique' => 'قبلا از این کد ملی استفاده شده است',
                'phone.required' => 'وارد کردن تلفن الزامی می باشد',
                'phone.numeric' => 'شماره تلفن وارد شده صحیح نمی باشد',

            ]
        );
        $request['password'] = Hash::make($request->password);
        $user = new User($request->all());
        if ($user->save()) {
            return Redirect::route('users.list')->with('alert.success', 'کاربر با موفقیت ثبت گردید');
        }
        return back()->withInput()->with('alert.danger', 'خطا در ثبت اطلاعات');
    }

    public function show(User $user)
    {
        return view('backend.users.show', ['user'=>$user]);
    }

    public function delete(User $user)
    {
        if ($user->delete()) {
            return back()->with('alert.warning','کاربر با موفقیت حذف گردید');
        }
        return back()->with('alert.danger', 'خطا در حذف اطلاعات');
    }

    public function Search(Request $request)
    {
        if($request->has('search')){
            $users = User::search($request->get('search'))->get();
        }else{
            $users = User::get();
        }


        return view('backend.users.list', compact('users'));
    }


}
