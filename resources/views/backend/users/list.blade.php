@php
    $crumbs = [
        ['name'=> 'لیست اعضاء', 'url'=> '#']
    ]
@endphp

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



        {{--<div class="col-xs-2" style="margin-bottom: 9px">--}}
            {{--<a href="{{ route('users.create') }}" class="btn btn-lg bg-white" style="border-color: grey;border-radius: 50%" data-toggle="tooltip" title="ثبت کاربر جدید">--}}
                {{--<i class="fa fa-user-plus"></i>--}}
            {{--</a>--}}
        {{--</div>--}}

        <br>
        <div class="col-md-8 col-sm-8 col-xs-12">
            <a href="{{ route('users.create') }}" style="color:#131313;font-size:18px;">
                <span style="color:#129395; font-size:20px; margin-left: 6px" class="fa fa-user-plus" aria-hidden="true"></span>ثبت کاربر جدید
            </a>
        </div>

        <div class="col-md-4 col-sm-4 col-xs-12">
            @component('components.search')
            @endcomponent
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
                <th>@sortablelink('username', 'نام کاربری')</th>
                <th>@sortablelink('l_name', 'نام')</th>
                <th>@sortablelink('phone', 'شماره تلفن')</th>
                <th>@sortablelink('role', 'نقش کاربری')</th>
                <th>تاریخ عضویت</th>
                <th></th>
            </tr>
            @foreach($users as $user)
                <tr>
                    <td>{{$loop->index + 1}}</td>
                    <td class="text-center">{{ $user->username }}</td>
                    <td class="text-center">{{$user->fullname()}}</td>
                    <td class="text-center">{{ $user->phone }}</td>
                    <td class="text-center">{{ \App\Models\User::$roles[$user->role]}}</td>
                    <td class="text-center">{{ jdate($user->created_at)->format('%B %d، %Y') }}</td>
                    <td class="setting-icons text-center col-xs-1">
                        <a href="{{ route('users.show', [$user->id]) }}" class="btn btn-xs btn-primary" data-toggle="tooltip" title="نمایش کامل اطلاعات">
                            <i class="fa fa-info"></i>
                        </a>
                        <a href="{{ route('users.delete', [$user->id]) }}" class="btn btn-xs btn-danger" data-toggle="tooltip" title="حذف کاربر">
                            <i class="fa fa-trash"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
        {{ $users->links() }}
    @endcomponent
@endsection

