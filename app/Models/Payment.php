<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }
}
