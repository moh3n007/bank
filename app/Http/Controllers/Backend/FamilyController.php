<?php

namespace App\Http\Controllers\Backend;

use App\Models\Account;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Family;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;

class FamilyController extends Controller
{
    public function familyList()
    {
        $families = Family::paginate($this->pagination_number);
        return view('backend.families.list', ['families'=>$families]);
    }

    public function createForm(Family $family = null)
    {
        $users = User::all();
        return view('backend.families.create', ['family'=>$family] , ['users'=>$users]);
    }

    public function store(Request $request)
    {
        $request->validate(
        [
            'name' => 'required'
        ],
        [
            'name.required' => 'وارد کردن نام خانواده الزامی می باشد'
        ]
        );
        $family = new Family($request->all());
        if ($family->save()) {
            return Redirect::route('families.show', [$family->id])->with('alert.success', 'خانواده با موفقیت ثبت گردید');
        }
        return back()->withInput()->with('alert.danger', 'خطا در ثبت اطلاعات');
    }

    public function show(Family $family)
    {
//        $head = $family->head();
//        dd($head);
        $names = Account::all();
        $accounts = $family ->accounts()->get();
//        dd($accounts);
        return view('backend.families.show', compact('family','accounts','names'));
    }

    public function update(Request $request , Family $family)
    {
        $family -> update($request->all());
        return back()->with('alert.success', 'نام گروه با موفقیت تغییر یافت');
    }

}
