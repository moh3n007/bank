@extends('layouts.master')

@section('content')
    @component('forms.panel', ['title'=>'لیست کاربران'])
        {{--<div class="col-md-offset-1" style="width: 45px;height: 45px;margin-bottom: 9px">--}}
            {{--<a href="{{ route('users.create') }}" data-toggle="tooltip" title="ثبت کاربر جدید">--}}
            {{--<!-- small box -->--}}
                {{--<div class="small-box bg-green">--}}
                    {{--<div class="inner">--}}
                        {{--<i class="fa fa-plus text-center" style="font-size: 25px;padding-right: 3px;padding-top: 3px"></i>--}}
                    {{--</div>--}}
                {{--</div>--}}
            {{--</a>--}}
        {{--</div>--}}



        <div class="col-xs-2" style="margin-bottom: 9px">
            <a href="{{ route('users.create') }}" class="btn btn-lg bg-green" data-toggle="tooltip" title="ثبت کاربر جدید">
                <i class="fa fa-user-plus"></i>
            </a>
        </div>
        <div class="col-xs-4 col-xs-offset-6">
        <form action="{{ route('users.search') }}" class="navbar-form navbar-left pull-left"   method="get" accept-charset="utf-8">
            {{csrf_field()}}
            <div style="display:none;">
                <input type="hidden" name="_method" value="POST">
            </div>
            <div class="form-group">
                <input name="search_term" value="{{ old('search') }}" type="text" class="form-control input-sm" placeholder="جستجو">
            </div>
            <div class="btn-group btn-group-sm">
                <button style="margin-left: 0;" type="submit" class="btn btn-sm btn-info" title="" data-original-title="جستجو"><span class="fa fa-search"></span></button>
                <button type="submit" name="clear" class="btn btn-sm btn-primary" title="" data-original-title="پاک سازی جستجو"><span class="fa fa-times"></span></button>
            </div>
        </form>
        </div>

        {{--<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">--}}
            {{--<ul class="nav navbar-nav">--}}
                {{--<li>--}}
                    {{--<a href="{{ route('users.create') }}" class="text-center">--}}
                        {{--<span style="color: green;font-size: 40px" class="glyphon glyphicon-plus text-center" aria-hidden="true"></span>--}}
                    {{--</a>--}}
                {{--</li>--}}
            {{--</ul>--}}
        {{--</div>--}}
        <table class="table table-responsive table-striped">
            <tr>
                <th>#</th>
                <th>نام کاربری</th>
                <th>نام</th>
                <th>شماره تلفن</th>
                <th>نقش کاربری</th>
                <th>تاریخ عضویت</th>
                <th></th>
            </tr>
            @foreach($users as $user)
                <tr>
                    <td>{{$loop->index + 1}}</td>
                    <td class="text-center">{{ $user->username }}</td>
                    <td class="text-center">{{$user->f_name.' '.$user->l_name}}</td>
                    <td class="text-center">{{ $user->phone }}</td>
                    <td class="text-center">{{ \App\Models\User::$roles[$user->role]}}</td>
                    <td class="text-center">{{ $user->created_at }}</td>
                    <td class="text-center col-xs-1">
                        <a href="{{ route('users.show', [$user->id]) }}" class="btn btn-xs btn-primary" data-toggle="tooltip" title="نمایش کامل اطلاعات">
                            <i class="fa fa-info"></i>
                        </a>
                    </td>
                    <td class="text-center col-xs-1">
                        <a href="{{ route('users.delete', [$user->id]) }}" class="btn btn-xs btn-danger" data-toggle="tooltip" title="حذف کاربر">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    @endcomponent
@endsection

