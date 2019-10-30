<?php

namespace App\Http\Controllers\Backend;

use App\Models\Account;
use App\Models\Family;
use App\Models\Interval;
use App\Models\Loan;
use App\Models\Payment;
use App\Models\SystemOption;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoanController extends Controller
{

    public function loanList()
    {
        $loans = Loan::paginate($this->pagination_number);
//        dd($loans->all());
        return view('backend.loans.list', ['loans'=>$loans]);
    }

    public function show(Loan $loan)
    {

        return view('backend.loans.show' , ['loan'=>$loan]);
    }

    public function store(Request $request, Family $family)
    {
        $accounts = Account::sum('amount');
        $intervals = Interval::whereNotNull('pay_date')->sum('amount');
        $loans = Loan::sum('amount');
        $payments = Payment::whereNotNull('pay_date')->sum('amount');
        $sum_all_monies = $intervals - $loans + $payments;

        $loan_factor = SystemOption::getOption('loan_factor');
        $account_id = $family->accounts()->pluck('id');
        $full_amount = Interval::with('account')
        ->whereIn('account_id',$account_id)->get();
        $sum = $full_amount->sum('amount');
        $max = $loan_factor * $sum;
//        if ($family->accounts()->count('id')>1) {
//            $pay_factor = SystemOption::getOption('pay_factor_for_more_than_one_account');
//            $min_loan_pay_from_db = SystemOption::getOption('minimal_loan_payment');
//            $count_account = $family->accounts()->count('id');
//            $min_loan_pay = intval($min_loan_pay_from_db + $pay_factor*$count_account*$min_loan_pay_from_db);
//        } else {
//            $min_loan_pay = SystemOption::getOption('minimal_loan_payment');
//        }
        $min_loan_pay = SystemOption::getOption('minimal_loan_payment');
//        dd($min_loan_pay);
        if ($sum_all_monies>$max) {
        $request->validate(
            [
                    'amount' => "required|numeric|max:$max+1|min:0",
                'min_loan_pay' => "numeric|min:$min_loan_pay"
            ],
            [
                'amount.required' => 'لطفا مقدار وام را وارد کنید',
                'amount.max'=> 'مقدار وام اختصاص یافته بیش از سقف مجاز است',
                'min_loan_pay.min' => 'مقدار قسط ماهیانه کمتر از مقدار حداقل مجاز می باشد'
            ]
        );} else {
            $request->validate(
                [
                    'amount' => "required|numeric|max:$sum_all_monies|min:0",
                    'min_loan_pay' => "numeric|min:$min_loan_pay"
                ],
                [
                    'amount.required' => 'لطفا مقدار وام را وارد کنید',
                    'amount.max'=> 'مقدار وام اختصاص یافته بیش از موجودی صندوق است',
                    'min_loan_pay.min' => 'مقدار قسط ماهیانه کمتر از مقدار حداقل مجاز می باشد'
                ]
            );};
//        dd($request->all());
        $max_loan = (int)$sum* (int)$loan_factor;
        $temp = $max_loan / $min_loan_pay;
        $pay_count = intval($temp);
        if (($max_loan % (int)$min_loan_pay)>0) {
            $pay_count++;
        }
//        dd($pay_count);

        $payments = [];
        for ($i=1;$i<$pay_count;$i++) {
            //$pay_date_year_.$i = "$request->pay_date_day_".$i,
            $year = $request['pay_date_year_'.$i];
            $month = str_pad($request['pay_date_month_'.$i],2,0,STR_PAD_LEFT);
            $day = str_pad($request['pay_date_day_'.$i],2,0,STR_PAD_LEFT);
            $date = jdate()->fromformat('Y-m-d',"$year-$month-$day")->toCarbon();
            $amount = $request->get('pay_amount_'.$i);
            $payments[] = new Payment([
                'due_date' => $date,
                'amount' => $amount,
            ]);
        }

        $loan = new Loan([
            'family_id' => $family->id,
            'amount' => $request->amount,
            'start_date' => $payments[0]->due_date,
            'finish_date' => $payments[sizeof($payments)-1]->due_date,
            ]);

        $result =\DB::transaction(function () use ($loan, $payments){
            $loan->save();
            $loan->payments()->saveMany($payments);
            return true;
        });

        if ($result) {
            return back()->with('alert.success', 'وام با موفقیت ثبت گردید');
        }
        return back()->withInput()->with('alert.danger', 'خطا در ثبت اطلاعات');
    }

    public function delete(Loan $loan)
    {
        if ($loan->delete()) {
            return back()->with('alert.warning','وام با موفقیت حذف گردید');
        }
        return back()->with('alert.danger', 'خطا در حذف اطلاعات');
    }

    public function monthlyPayments(Request $request)
    {
        $now = jdate();
        $payYear = (string)$now->getYear();
        $payMonth = str_pad($now->addMonths(1)->getMonth(),2,0,STR_PAD_LEFT);
        $payDay = str_pad(5,2,0,STR_PAD_LEFT);
        $date = jdate()->fromformat('Y-m-d',"$payYear-$payMonth-$payDay")->toCarbon()->toDateString();
        $payDates = Payment::with('loan','loan.family')->where('due_date',$date)->paginate($this->pagination_number);
        $pastDates = Payment::with('loan','loan.family')
            ->where('due_date','<',$now->toCarbon())
            ->where('pay_date',Null)
            ->paginate($this->pagination_number);

        return view('backend.loans.monthlyPayments' , ['payDates'=>$payDates],['pastDates'=>$pastDates]);
    }

    public function pay(Request $request)
    {
        unset($request['_token']);
        $result = Payment::whereIn('id', array_keys($request->all()))->update(['pay_date' => Carbon::now()]);
//        dd($request->all());
        if ($result) {
            return back()->with('alert.success', 'پرداخت قسط با موفیقت انجام گرفت');
        }
        return back()->with('alert.danger', 'خطا در ثبت اطلاعات');

    }

    public function pay_in_show_loan(Request $request)
    {

        $result = Payment::whereIn('id', array_keys($request->all()))->update(['pay_date' => Carbon::now()]);
        //dd($result);
        if ($result) {
            return back()->with('alert.success', 'پرداخت قسط با موفیقت انجام گرفت');
        }
        return back()->with('alert.danger', 'خطا در ثبت اطلاعات');
    }
}
