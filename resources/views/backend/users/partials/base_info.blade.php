@component('forms.panel', ['title'=>'نمایش اطلاعات کامل'])


    <br>
    <div>
        <a href="{{ route('users.edit' , [$user->id]) }}" style="color:#131313;font-size:18px;">
            <span style="color:#089504; font-size:20px; margin-left: 6px" class="fa fa-edit" aria-hidden="true"></span>ویرایش
        </a>
    </div>
    <br>
        {{--<div class="col-md-12 pull-right" style="margin-bottom: 9px">--}}
            {{--<a href="{{ route('users.edit' , [$user->id]) }}" class="btn btn-lg text-yellow" style="font-size: 25px" data-toggle="tooltip" title="تغییر اطلاعات">--}}
                {{--<i class="fa fa-edit"></i>--}}
            {{--</a>--}}
        {{--</div>--}}

        <div class="col-md-12">
            <div class="box-header with-border">
                <div class="clear"></div>
                <div class="well">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <dl>
                                <dt>نام و نام خانوادگی</dt>
                                <dd style="margin-bottom: 10px">{{ $user->fullname()}}</dd>
                                <dt>نام کاربری</dt>
                                <dd style="margin-bottom: 10px">{{ $user->username}}</dd>
                                <dt>نقش کاربری</dt>
                                <dd style="margin-bottom: 10px">{{ \App\Models\User::$roles[$user->role]}}</dd>
                                <dt>شماره تلفن</dt>
                                <dd style="margin-bottom: 10px">{{ $user->phone}}</dd>
                            </dl>
                        </div>
                        <div class="col-md-6 text-center">
                            <dl>
                                    <dt>جنسیت</dt>
                                    <dd style="margin-bottom: 10px">{{ \App\Models\User::$genders[$user->gender]}}</dd>
                                    <dt>شماره ملی</dt>
                                    <dd style="margin-bottom: 10px">{{ $user->national_code}}</dd>
                                    <dt>آدرس</dt>
                                    <dd style="margin-bottom: 10px">{{ $user->address}}</dd>
                                </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endcomponent