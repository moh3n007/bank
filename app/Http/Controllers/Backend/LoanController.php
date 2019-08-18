<?php

namespace App\Http\Controllers\Backend;

use App\Models\Family;
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
        return view('backend.loans.list', ['loans'=>$loans]);
    }

    public function show(Loan $loan)
    {
        return view('backend.loans.show' , ['loan'=>$loan]);
    }

    public function store(Request $request, Family $family)
    {
        $loan_factor = SystemOption::getOption('loan_factor');
        $sum = $family->accounts()->sum('amount');
        $max = $loan_factor * $sum;
        $min_loan_pay = SystemOption::getOption('minimal_loan_payment');
        $request->validate(
            [
                'amount' => "required|numeric|max:$max|min:0",
                'min_loan_pay' => "numeric|min:$min_loan_pay"
            ],
            [
                'amount.required' => 'لطفا مقدار وام را وارد کنید',
                'amount.max'=> 'مقدار وام اختصاص یافته بیش از سقف مجاز است',
                'min_loan_pay.min' => 'خیلی خری'
            ]
        );
//        dd($request->all());
        $max_loan = (int)$sum* (int)$loan_factor;
        $temp = $max_loan / $min_loan_pay;
        $pay_count = intval($temp);
        if (($max_loan % (int)$min_loan_pay)>0) {
            $pay_count++;
        }

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
                'amount' => $amount
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
