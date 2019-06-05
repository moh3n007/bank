<?php

namespace App\Http\Controllers\Backend;

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
        return view('backend.families.create', ['family'=>$family]);
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
            return Redirect::route('families.create', [$family->id])->with('alert.success', 'خانواده با موفقیت ثبت گردید');
        }
        return back()->withInput()->with('alert.danger', 'خطا در ثبت اطلاعات');
    }

    public function show(Family $family)
    {

        $users = User::all();
        return view('backend.families.show', ['family'=>$family , 'users'=>$users]);
    }

}
