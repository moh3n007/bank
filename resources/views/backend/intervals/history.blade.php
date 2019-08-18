@php
    $crumbs = [
        ['name'=> 'تاریخچه پرداخت ها', 'url'=> route('intervals.history')]
    ]
@endphp

@extends('layouts.master')

@section('content')
    @component('forms.panel', ['title'=>'تاریخچه پرداخت ها'])

    <table class="table table-responsive table-striped">
        <tr>
            <th>#</th>
            <th>نام دارنده حساب</th>
            <th>مقدار پرداختی</th>
            <th>شماره حساب</th>
            <th>تاریخ پرداخت</th>
            <th></th>
        </tr>
        @foreach($intervals as $interval)
            <tr>
                <td>{{$loop->index + 1}}</td>
                <td class="text-center">{{ @$interval->account->user->fullname() }}</td>
                <td class="text-center">{{ @$interval->amount }}</td>
                <td class="text-center">{{ @$interval->account->account_number }}</td>
                <td class="text-center">{{ @$interval->pay_date }}</td>
                <td class="setting-icons text-center col-xs-1">
                    <a href="#" class="btn btn-xs btn-primary" data-toggle="tooltip" title="نمایش کامل اطلاعات">
                        <i class="fa fa-info"></i>
                    </a>
                    <a href="#" class="btn btn-xs btn-danger" onclick="return checkDelete()" data-toggle="tooltip" title="حذف وام">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
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
