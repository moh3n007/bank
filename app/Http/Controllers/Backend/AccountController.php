<?php

namespace App\Http\Controllers\Backend;

use App\Models\Account;
use App\Models\Family;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class AccountController extends Controller
{
    public function accountList()
    {
        $accounts = Account::with('user','family')->paginate($this->pagination_number);
        return view('backend.accounts.list', ['accounts'=>$accounts]);
    }

    public function createForm()
    {
        $users = User::all();
        $families = Family::all();
        return view('backend.accounts.create', ['users'=>$users] , ['families'=>$families]);
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'account_number' => 'required',
                'amount' => 'required'
            ],
            [
                'account_number.required' => 'وارد کردن شماره حساب الزامی می باشد',
                'amount.required' => 'وارد کردن موجودی اولیه حساب الزامی می باشد'
            ]
        );
        $account = new Account($request->all());
        //dd($account);
        if ($account->save()) {
            return Redirect::route('accounts.list')->with('alert.success', 'حساب با موفقیت ثبت گردید');
        }
        return back()->withInput()->with('alert.danger', 'خطا در ثبت اطلاعات');
    }
}
