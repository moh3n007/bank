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
        ]);
    }
}
