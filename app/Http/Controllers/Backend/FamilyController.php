<?php

namespace App\Http\Controllers\Backend;

use App\Models\Account;
use App\Models\SystemOption;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Family;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use function PHPSTORM_META\map;

class FamilyController extends Controller
{
    public function familyList()
    {
        $families = Family::paginate($this->pagination_number);
        return view('backend.families.list', ['families'=>$families]);
    }

    public function createForm(Family $family = null)
    {
        $users = User::all();
        return view('backend.families.create', ['family'=>$family] , ['users'=>$users]);
    }

    public function store(Request $request)
    {
        $request->validate(
        [
            'name' => 'required'
        ],
        [
            'name.required' => 'وارد کردن نام خانواده الزامی می باشد'
        ]
        );
        $family = new Family($request->all());
        if ($family->save()) {
            return Redirect::route('families.show', [$family->id])->with('alert.success', 'خانواده با موفقیت ثبت گردید');
        }
        return back()->withInput()->with('alert.danger', 'خطا در ثبت اطلاعات');
    }

    public function show(Family $family)
    {
        $accounts = Account::with('user')
            ->whereNotIn('id', $family->accounts()->pluck('id'))
            ->get()
            ->map(function ($item){
            return [
                'id' => $item->id,
                'name'=>$item->user->fullname() . '('.$item->account_number.')'
            ];
        });
        $count = $family->accounts()->count('id');
        $full_amount = $family->accounts();
        $sum = $full_amount->sum('amount');
        $min_accounts = SystemOption::all()->find('5');
        $loan_factor = SystemOption::all()->find('1');
        $min_loan_pay = SystemOption::all()->find('3');
        $loan_pay_day = SystemOption::all()->find('4');
        return view('backend.families.show', [
            'family'=>$family,
            'accounts'=>$accounts,
            'count'=>$count,
            'sum'=>$sum,
            'min_accounts'=>$min_accounts,
            'loan_factor'=>$loan_factor,
            'min_loan_pay'=>$min_loan_pay,
            'loan_pay_day'=>$loan_pay_day

        ]);
    }

    public function update(Request $request , Family $family)
    {
        $family -> update($request->all());
        return back()->with('alert.success', 'نام گروه با موفقیت تغییر یافت');
    }

    public function addAccount(Request $request, Family $family)
    {
        $account = Account::find($request->account_id);
        if($family->accounts()->save($account)){
            return back()->withInput()->with('alert.success', 'گروه با موفقیت ثبت گردید');
        }
        return back()->withInput()->with('alert.danger', 'خطا در ثبت اطلاعات');
    }

    public function setHead(Family $family, $user_id)
    {
        $family->head_id = $user_id;
        $family->save();
        return back();
    }

}
