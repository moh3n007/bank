<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{

    protected $fillable = [
        'account_number',
        'amount'
    ];

    public function users()
    {
        return $this->belongsTo(User::class);
    }

    public function families()
    {
        return $this->belongsTo(Family::class);
    }
}
