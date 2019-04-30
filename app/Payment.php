<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
