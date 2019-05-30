<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    public function families()
    {
        return $this->belongsTo(Family::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
