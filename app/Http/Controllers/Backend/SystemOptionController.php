<?php

namespace App\Http\Controllers\Backend;

use App\Models\SystemOption;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SystemOptionController extends Controller
{
    public function option()
    {
        $options = SystemOption::all();
        return view('backend.systemOption.SystemOption' , ['options' => $options]);
    }

    public function edit(Request $request , SystemOption $option)
    {
        $option->value = $request[$option->name];
        if ($option->save()) {
            return back()->with('alert.success', 'تنظیمات با موفقیت ثبت گردید');
        }
        return back()->with('alert.danger', 'خطا در ثبت اطلاعات');
    }
}
