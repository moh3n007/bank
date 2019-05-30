<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    public function loans()
    {
        return $this->belongsTo(Loan::class);
    }
}
