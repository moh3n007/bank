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
        $query = Account::query();
        if(\request()->has('search_term') and \request()->get('search_term') != ''){
            $term = \request()->get('search_term');
            $query->whereHas('user', function ($query) use ($term){
                $query->where('username','like', "%$term%")
                    ->orWhere('l_name','like', "%$term%")
                    ->orWhere('f_name','like', "%$term%");
            })
            ->orWhere(function ($query) use ($term){
                $query->where('account_number',$term);
            });
        }

        $accounts = $query->paginate($this->pagination_number);
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

    public function show(Account $account)
    {
        $users = User::all();
        $families = Family::all();
        return view('backend.accounts.show',compact('account','users','families'));
    }

    public function Search(Request $request)
    {
        if($request->has('search')){
            $accounts = Account::search($request->get('search'))->get();
        }else{
            $accounts = Account::get();
        }


        return view('backend.accounts.list', compact('accounts'));
    }

    public function update(Request $request , Account $account)
    {
        $account -> update($request->all());
        return Redirect::route('accounts.list')->with('alert.success', 'اطلاعات حساب با موفقیت تغییر یافت');
    }

    public function delete(Account $account)
    {
        if ($account->delete()) {
            return back()->with('alert.warning','حساب با موفقیت حذف گردید');
        }
        return back()->with('alert.danger', 'خطا در حذف اطلاعات');
    }

}
