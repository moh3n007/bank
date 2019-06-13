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
        $option = new \App\Models\SystemOption ([

            'name' => 'loan_factor',
            'value' => '2',
            'f_name' => 'ضریب وام'

        ]);
        $option->save();
    }
}
