<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }
}
