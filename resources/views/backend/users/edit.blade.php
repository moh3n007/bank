@php
    $crumbs = [
        ['name'=> 'لیست اعضاء', 'url'=> route('users.list')],
        ['name'=> $user->fullname(), 'url'=> route('users.show', [$user->id])],
        ['name'=> 'تغییر اطلاعات', 'url'=> '#'],
    ]
@endphp

@extends('layouts.master')

@section('content')

    @component('forms.panel', ['title'=>'تغییر اطلاعات کاربر'])
        <form action="{{ route('users.update' ,[$user->id]) }}" method="POST">
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-8 col-md-push-2">
                    @component('forms.input', [
                        'name'=>'f_name',
                        'label'=>'نام',
                        'required'=>true,
                        'value'=>$user->f_name
                    ])
                    @endcomponent
                    @component('forms.input', [
                        'name'=>'l_name',
                        'label'=>'نام خانوادگی',
                        'required'=>true,
                        'value'=>$user->l_name
                    ])
                    @endcomponent
                    @component('forms.input', [
                        'name'=>'username',
                        'label'=>'نام کاربری',
                        'required'=>true,
                        'value'=>$user->username
                    ])
                    @endcomponent
                    @component('forms.input', [
                            'name'=>'password',
                            'label'=>'رمز عبور',
                            'required'=>true,
                            'type'=>'password',
                            'value'=>''
                        ])
                    @endcomponent
                    @component('forms.input', [
                        'name'=>'email',
                        'label'=>'پست الکترونیکی',
                        'type'=>'email',
                        'value'=>$user->email
                    ])
                    @endcomponent
                    @component('forms.select', [
                            'name'=>'gender',
                            'label'=>'جنسیت',
                            'required'=>true,
                            'options' => \App\Models\User::$genders,
                        ])
                    @endcomponent
                    @component('forms.input', [
                        'name'=>'national_code',
                        'label'=>'کد ملی',
                        'type'=>'number',
                        'options' => [
                            'maxlength' => 10,
                            'minlength' => 10,
                        ],
                        'value'=>$user->national_code
                    ])
                    @endcomponent
                    @component('forms.input', [
                            'name'=>'phone',
                            'label'=>'شماره تلفن',
                            'required'=>true,
                            'type'=>'number',
                            'value'=>$user->phone
                        ])
                    @endcomponent
                    @component('forms.textarea', [
                            'name'=>'address',
                            'label'=>'آدرس',
                            'value'=>$user->address
                        ])
                    @endcomponent
                    @component('forms.select', [
                        'name'=>'role',
                        'label'=>'نقش کاربری',
                        'required'=>true,
                        'options' => \App\Models\User::$roles,
                    ])
                    @endcomponent
                    <button type="submit" class="btn btn-primary">تغییر اطلاعات </button>
                </div>
            </div>
        </form>
    @endcomponent

@endsection
