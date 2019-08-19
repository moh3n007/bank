<?php

namespace App\Http\Controllers\Backend;

use App\Models\Account;
use App\Models\Family;
use App\Models\Interval;
use App\Models\Payment;
use App\Models\SystemOption;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rules\In;

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
        return view('backend.accounts.show',['account'=>$account],['users'=>$users],['families'=>$families]);
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

    public function showIntervals()
    {
        $amount = SystemOption::getOption('interval_payment');
        $now = jdate();
        $year = (string)$now->getYear();
        $month = str_pad($now->getMonth(),2,0,STR_PAD_LEFT);
        $firstDay = jdate()->fromformat('Y-m-d',"$year-$month-01");
        $lastDay = $firstDay->getNextMonth();
        $payedAccountIds = Interval::where('pay_date', '>=', $firstDay->toCarbon())
            ->where('pay_date', '<', $lastDay->toCarbon())
            ->pluck('account_id');
        $accounts = Account::with('user','intervals')->get();

        return view('backend.intervals.showIntervals' , ['accounts'=>$accounts , 'payedAccountIds'=>$payedAccountIds , 'amount' =>$amount]);
    }

    public function storeIntervals(Request $request)
    {
        unset($request['_token']);
        $result = array();
        foreach ($request->all() as $key=>$value) {
            $result[] = [

                'created_at' => Carbon::now(),
                'amount' => SystemOption::getOption('interval_payment'),
                'account_id' => $key,
                'month' => jdate()->getMonth()

            ];
        }
//        dd($request->all());
        if (!isset($result)) {
            Interval::insert($result);
        }

        return Redirect::route('intervals.intervals');
    }

    public function monthlyIntervals()
    {

        $intervals = Interval::whereNull('pay_date')->get();
        $getMonthNow = jdate()->getMonth();
        $dueIntervals = $intervals->where('month',$getMonthNow);
        $pastIntervals = $intervals->where('month' , '<' , $getMonthNow);
//        dd($pastIntervals);


        return view('backend.intervals.monthlyIntervals' ,
            ['dueIntervals' => $dueIntervals , 'pastIntervals' => $pastIntervals]
        );
    }

    public function pay(Request $request)
    {
        unset($request['_token']);
//        dd($request->all());
        $result = Interval::whereIn('id', array_keys($request->all()))->update(['pay_date' => Carbon::now()]);
        if ($result) {
            return back()->with('alert.success', 'پرداخت با موفیقت انجام گرفت');
        }
        return back()->with('alert.danger', 'خطا در ثبت اطلاعات');
    }

    public function history()
    {
        $intervals = Interval::with('account')->whereNotNull('pay_date')->get();
//        dd($intervals);
        return view('backend.intervals.history' , ['intervals' => $intervals]);
    }
}
