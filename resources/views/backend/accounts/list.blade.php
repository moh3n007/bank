@php
    $crumbs = [
        ['name'=> 'لیست حساب ها', 'url'=> '#']
    ]
@endphp

@extends('layouts.master')

@section('content')
    @component('forms.panel', ['title'=>'لیست حساب ها'])
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
            {{--<a href="{{ route('accounts.create') }}" class="btn btn-lg bg-white" style="border-color: grey;border-radius: 50%" data-toggle="tooltip" title="ثبت حساب جدید">--}}
                {{--<i class="fa fa-plus-square"></i>--}}
            {{--</a>--}}
        {{--</div>--}}

        <div class="col-md-8 col-sm-8 col-xs-12" style="padding-top: 7px">
            <a href="{{ route('accounts.create') }}" style="color:#131313;font-size:18px;">
                <span style="color:#129395; font-size:20px; margin-left: 6px" class="fa fa-plus-square" aria-hidden="true"></span>ثبت حساب جدید
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
            @if($accounts == null)
                 <span style="color: red;">هیچ حسابی ثبت نشده است</span>
            @else
                <tr>
                    <th>#</th>
                    <th>نام دارنده حساب</th>
                    <th>نام گروه</th>
                    <th>شماره حساب</th>
                    <th>موجودی اولیه حساب</th>
                    <th>تاریخ ایجاد</th>
                    <th></th>
                </tr>
                @foreach($accounts as $account)
                    <tr>
                        <td>{{$loop->index + 1}}</td>
                        <td class="text-center">{{ @$account->user->fullname()}}</td>
                        <td class="text-center">{{ @$account->family->name }}</td>
                        <td class="text-center">{{ @$account->account_number }}</td>
                        <td class="text-center">{{ @$account->amount }}</td>
                        <td class="text-center">{{ @jdate($account->created_at)->format('%B %d، %Y') }}</td>
                        <td class="setting-icons text-center col-xs-1">
                            <a href="{{ route('accounts.show' , [$account->id]) }}" class="btn btn-xs btn-primary" data-toggle="tooltip" title="نمایش کامل اطلاعات">
                                <i class="fa fa-info"></i>
                            </a>
                            <a href="{{ route('accounts.delete', [$account->id]) }}" class="btn btn-xs btn-danger" onclick="return checkDelete()" data-toggle="tooltip" title="حذف حساب">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </table>
        {{ $accounts->links() }}
    @endcomponent
@endsection

@section('script')
    <script language="JavaScript" type="text/javascript">
        function checkDelete(){
            return confirm('آیا مطمئن هستید؟');
        }
    </script>
@endsection
