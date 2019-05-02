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
        $user = new \App\User([
            'username'=> 'admin',
            'role'=> 'admin',
            'password' => Hash::make('nimda'),
            'f_name' => 'Mr',
            'l_name' => 'admin',
            'national_code' => '1111111111',
            'phone' => '1111111111',
            'gender' => 'male',
        ]);
        $user->save();
    }
}
