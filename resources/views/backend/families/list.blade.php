@php
    $crumbs = [
        ['name'=> 'لیست گروه ها', 'url'=> '#']
    ]
@endphp

@extends('layouts.master')

@section('content')
    @component('forms.panel', ['title'=>'لیست گروه ها'])
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
            {{--<a href="{{ route('families.create') }}" class="btn btn-lg bg-white" style="border-color: grey;border-radius: 50%" data-toggle="tooltip" title="ثبت گروه جدید">--}}
                {{--<i class="fa fa-users"></i>--}}
            {{--</a>--}}
        {{--</div>--}}

        <div class="col-md-8 col-sm-8 col-xs-12" style="padding-top: 7px">
            <a href="{{ route('families.create') }}" style="color:#131313;font-size:18px;">
                <span style="color:#129395; font-size:20px; margin-left: 6px" class="fa fa-users" aria-hidden="true"></span>ثبت گروه جدید
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
            @if($families == "")
                <span style="color: red;">هیچ گروهی ثبت نشده است</span>
            @else
                <tr>
                    <th>#</th>
                    <th>نام خانواده</th>
                    <th>تاریخ ایجاد</th>
                    <th></th>
                </tr>
                @foreach($families as $family)
                    <tr>
                        <td>{{$loop->index + 1}}</td>
                        <td class="text-center">{{ $family->name }}</td>
                        <td class="text-center">{{ jdate($family->created_at)->format('%B %d، %Y') }}</td>
                        <td class="setting-icons text-center col-xs-1">
                            <a href="{{ route('families.show' , [$family->id]) }}" class="btn btn-xs btn-primary" data-toggle="tooltip" title="نمایش کامل اطلاعات">
                                <i class="fa fa-info"></i>
                            </a>
                            <a href="{{ route('families.delete' , [$family->id]) }}" class="btn btn-xs btn-danger" onclick="return checkDelete()" data-toggle="tooltip" title="حذف گروه">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </table>
    @endcomponent
@endsection

@section('script')
    <script language="JavaScript" type="text/javascript">
        function checkDelete(){
            return confirm('آیا مطمئن هستید؟');
        }
    </script>
@endsection

