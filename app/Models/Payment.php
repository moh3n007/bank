<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $fillable = [
        'due_date',
        'amount'
    ];

    public function loan()
    {
        return $this->belongsTo(Loan::class);
    }

}
