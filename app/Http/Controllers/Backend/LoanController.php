<?php

namespace App\Http\Controllers\Backend;

use App\Models\Family;
use App\Models\SystemOption;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoanController extends Controller
{
    public function store(Request $request, Family $family)
    {
        $loan_factor = SystemOption::getOption('loan_factor');
        $sum = $family->accounts()->sum('amount');
        $max = $loan_factor * $sum;
        $request->validate(
            [
                'amount' => "required|numeric|max:$max|min:0"
            ],
            [
                'amount.required' => 'وارد کردن نام خانواده الزامی می باشد',
                'amount.max'=> 'مقدار وام اختصاص یافته بیش از صقف مجاز است'
            ]
        );
        dd($request->all());
    }
}
