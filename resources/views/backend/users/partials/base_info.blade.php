@component('forms.panel', ['title'=>'نمایش اطلاعات کامل'])


        <div class="col-md-12 pull-right" style="margin-bottom: 9px">
            <a href="{{ route('users.edit' , [$user->id]) }}" class="btn btn-lg text-yellow" style="border-color: grey;border-radius: 50%" data-toggle="tooltip" title="تغییر اطلاعات">
                <i class="fa fa-edit"></i>
            </a>
        </div>

        <div class="col-md-3">
            <div class="box-header with-border">
                <div class="clear"></div>
                <div class="well">
                    <div class="row">
                        <div class="col-md-12" style="margin-bottom: 10px">
                            <div class="profile-user-img" style="border-radius: 50%">
                                <img  src="{{ asset('image/1.jpg') }}" style="height: 87px;width: 87px;border-radius: 50%">
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <dl>
                                <dt>نام و نام خانوادگی</dt>
                                <dd style="margin-bottom: 10px">{{ $user->fullname() }}</dd>
                                <dt>نام کاربری</dt>
                                <dd>{{ $user->f_name}}</dd>
                            </dl>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-9">
            <div class="box-header with-border">
                <div class="clear"></div>
                <div class="well">
                    <div class="row">
                        <div class="col-md-6 text-center">
                            <dl>
                                <dt>پست الکترونیکی</dt>
                                <dd style="margin-bottom: 10px">{{ $user->email}}</dd>
                                <dt>شماره تلفن</dt>
                                <dd style="margin-bottom: 10px">{{ $user->phone}}</dd>
                                <dt>نقش کاربری</dt>
                                <dd style="margin-bottom: 10px">{{ \App\Models\User::$roles[$user->role]}}</dd>
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