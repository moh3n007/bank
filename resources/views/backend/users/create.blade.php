@extends('layouts.master')

@section('content')

    @component('forms.panel', ['title'=>'ثبت کاربر جدید'])
        <form action="{{route('users.create')}}" method="POST">
            {{csrf_field()}}
            <div class="row">
                <div class="col-md-8 col-md-push-2">
                    @component('forms.input', [
                        'name'=>'f_name',
                        'label'=>'نام',
                        'required'=>true,
                    ])
                    @endcomponent
                    @component('forms.input', [
                        'name'=>'l_name',
                        'label'=>'نام خانوادگی',
                        'required'=>true,
                    ])
                    @endcomponent
                    @component('forms.input', [
                        'name'=>'username',
                        'label'=>'نام کاربری',
                        'required'=>true,
                    ])
                    @endcomponent
                    @component('forms.input', [
                            'name'=>'password',
                            'label'=>'رمز عبور',
                            'required'=>true,
                            'type'=>'password'
                        ])
                    @endcomponent
                    @component('forms.input', [
                        'name'=>'email',
                        'label'=>'پست الکترونیکی',
                        'type'=>'email'
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
                        ]
                    ])
                    @endcomponent
                    @component('forms.input', [
                            'name'=>'phone',
                            'label'=>'شماره تلفن',
                            'required'=>true,
                            'type'=>'number'
                        ])
                    @endcomponent
                    @component('forms.textarea', [
                            'name'=>'address',
                            'label'=>'آدرس'
                        ])
                    @endcomponent
                    @component('forms.select', [
                        'name'=>'role',
                        'label'=>'نقش کاربری',
                        'required'=>true,
                        'options' => \App\Models\User::$roles,
                    ])
                    @endcomponent
                    <button type="submit" class="btn btn-primary">ثبت کاربر </button>
                </div>
            </div>
        </form>
    @endcomponent

@endsection
