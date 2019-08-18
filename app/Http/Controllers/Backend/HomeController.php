<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Interval;
use App\Models\Loan;
use App\Models\Payment;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accounts = Account::sum('amount');
        $intervals = Interval::whereNotNull('pay_date')->sum('amount');
        $loans = Loan::sum('amount');
        $payments = Payment::whereNotNull('pay_date')->sum('amount');
//        dd($payments);
        return view('home' , ['accounts' => $accounts , 'intervals' => $intervals , 'loans' => $loans , 'payments' => $payments]);
    }
}
