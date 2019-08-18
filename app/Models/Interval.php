<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interval extends Model
{

    protected $fillable = [
        'pay_date',
        'amount',
        'account_id'
    ];

    public function account()
    {
        return $this->belongsTo(Account::class);
    }

}
