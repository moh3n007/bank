<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    public function account()
    {
        return $this->hasMany(Account::class);
    }

    public function loan()
    {
        return $this->hasMany(Loan::class);
    }
}
