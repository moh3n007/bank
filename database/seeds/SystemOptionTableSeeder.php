<?php

use Illuminate\Database\Seeder;

class SystemOptionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\SystemOption::truncate();
        \App\Models\SystemOption::insert([
            [
                'name' => 'loan_factor',
                'value' => '2',
                'f_name' => 'ضریب وام'
            ],
            [
                'name' => 'interval_payment',
                'value' => '50000',
                'f_name' => 'قسط ماهیانه برای هر حساب'
            ],
            [
                'name' => 'minimal_loan_payment',
                'value' => '200000',
                'f_name' => 'حداقل قسط ماهیانه برای هر وام'
            ],
            [
                'name' => 'loan_payment_day',
                'value' => '5',
                'f_name' => 'روز پرداخت قسط وام'
            ],
            [
                'name' => 'minimum_account_balance_for_loan',
                'value' => '500000',
                'f_name' => 'حداقل موجودی حساب جهت دریافت وام'
            ],
            [
                'name' => 'pay_factor_for_more_than_one_account',
                'value' => '0.7',
                'f_name' => 'ضریب قسط وام برای بیش از یک حساب'
            ],
            [
                'name' => 'year_for_show_interval',
                'value' => '1398',
                'f_name' => 'تاریخ ابتدای نمایش در پرداختی ها'
            ]
        ]);
    }
}
