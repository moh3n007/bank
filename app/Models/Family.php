<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    protected $fillable = [
        'name',
        'head_id'
    ];

    public function headName()
    {
        if($this->head == null){
            return 'بدون نماینده گروه';
        }
        return $this->head->fullname();
    }

    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function head()
    {
        return $this->belongsTo(User::class,'head_id');
    }
}
