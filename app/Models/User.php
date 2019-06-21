<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Kyslik\ColumnSortable\Sortable;


class User extends Authenticatable
{
    use Notifiable,Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password','f_name','l_name','gender',
        'national_code','phone','address','role'
    ];

    public $sortable = [
        'username', 'email','l_name',
        'national_code','phone','role'];


    public static $roles = [
        'user' => 'کاربر',
        'admin' => 'مدیر'
    ];

    public static $genders = [
        'male' => 'مرد',
        'female' => 'زن'
    ];

    public function fullname()
    {
        return $this == null ? '' : $this->f_name.' '.$this->l_name;
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function accounts() {
        return $this->hasmany(Account::class);
    }
}
