<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        \App\Models\User::truncate();
        \App\Models\User::insert([
            [
                'username' => 'admin',
                'password' => \Illuminate\Support\Facades\Hash::make('admin'),
                'role' => 'admin',
                'f_name' => 'mr',
                'l_name' => 'admin',
                'phone' => '09380151562',
                'address' => 'rasht',
                'gender' => 'male',
                'national_code' => '2580231307'
            ]
        ]);
    }

}
