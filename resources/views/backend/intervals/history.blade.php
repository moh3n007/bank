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
        </tr>
        @foreach($intervals as $interval)
            <tr>
                <td>{{$loop->index + 1}}</td>
                <td class="text-center">{{ @$interval->account->user->fullname() }}</td>
                <td class="text-center">{{ @$interval->amount }}</td>
                <td class="text-center">{{ @$interval->account->account_number }}</td>
                <td class="text-center">{{ @jdate($interval->pay_date)->format('%d , %B ، %Y') }}</td>
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
