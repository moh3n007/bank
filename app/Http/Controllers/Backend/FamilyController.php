<?php

namespace App\Http\Controllers\Backend;

use App\Models\Account;
use App\Models\Loan;
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

    public function show(Request $request , Family $family)
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
        $count_loan = $family->loans()->count('id');
        if ($request->isMethod('post')){

            //TODO set validation min_loan_pay nabayad kochaktar az request bashad
            $year = $request['pay_date_year_1'];
            $month = str_pad($request['pay_date_month_1'],2,0,STR_PAD_LEFT);
            $day = str_pad($request['pay_date_day_1'],2,0,STR_PAD_LEFT);
            return view('backend.families.show', [
                'family'=>$family,
                'accounts'=>$accounts,
                'count'=>$count,
                'sum'=>$sum,
                'min_accounts'=>SystemOption::getOption('minimum_account_balance_for_loan'),
                'loan_factor'=>SystemOption::getOption('loan_factor'),
                'min_loan_pay'=>$request->min_loan_pay,
                'loan_pay_day'=>SystemOption::getOption('loan_payment_day'),
                'count_loan'=>$count_loan,
                'max_loan'=>$request->amount,
                'pay_date_1'=>jdate()->fromformat('Y-m-d',"$year-$month-$day"),

            ]);
        }
        return view('backend.families.show', [
            'family'=>$family,
            'accounts'=>$accounts,
            'count'=>$count,
            'sum'=>$sum,
            'min_accounts'=>SystemOption::getOption('minimum_account_balance_for_loan'),
            'loan_factor'=>SystemOption::getOption('loan_factor'),
            'min_loan_pay'=>SystemOption::getOption('minimal_loan_payment'),
            'loan_pay_day'=>SystemOption::getOption('loan_payment_day'),
            'count_loan'=>$count_loan
        ]);
    }

    public function update(Request $request , Family $family)
    {
        $family -> update($request->all());
        return back()->with('alert.success', 'نام گروه با موفقیت تغییر یافت');
    }

    public function delete(Family $family)
    {
        if ($family->delete()) {
            return back()->with('alert.warning','خانواده با موفقیت حذف گردید');
        }
        return back()->with('alert.danger', 'خطا در حذف اطلاعات');
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
