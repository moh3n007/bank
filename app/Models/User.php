<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password','f_name','l_name','gender',
        'national_code','phone','address','role'
    ];

    public static $roles = [
        'user' => 'کاربر',
        'admin' => 'مدیر'
    ];

    public static $genders = [
        'male' => 'مرد',
        'female' => 'زن'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function account() {
        return $this->hasmany(Account::class);
    }
}
