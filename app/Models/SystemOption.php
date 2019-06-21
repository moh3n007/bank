<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SystemOption extends Model
{
    public static function getOption($name)
    {
        return SystemOption::where('name',$name)->value('value');
    }
}
