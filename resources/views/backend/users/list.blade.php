@extends('layouts.master')

@section('content')
    @component('forms.panel', ['title'=>'لیست کاربران'])
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
                    <td class="text-center">
                        <a href="{{ route('users.show', [$user->id]) }}" class="btn btn-xs btn-default" data-toggle="tooltip" title="نمایش کامل اطلاعات">
                            <i class="fa fa-info"></i>
                        </a>
                    </td>
                </tr>
            @endforeach
        </table>
    @endcomponent
@endsection
