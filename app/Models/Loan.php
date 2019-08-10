<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{

    protected $fillable = [
        'family_id',
        'amount',
        'start_date',
        'finish_date'

    ];

    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
