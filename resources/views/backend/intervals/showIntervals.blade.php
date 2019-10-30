@php
    $crumbs = [
        ['name'=> 'مشاهده پرداختی ماهیانه', 'url'=> '#']
    ];

    $months = [
        1=>'فروردین',
        2=>'اردیبهشت',
        3=>'خرداد',
        4=>'تیر',
        5=>'مرداد',
        6=>'شهریور',
        7=>'مهر',
        8=>'آبان',
        9=>'آذر',
        10=>'دی',
        11=>'بهمن',
        12=>'اسفند',
    ];

@endphp

@extends('layouts.master')

@section('content')

    @component('forms.panel', ['title'=>'لیست پرداختی جاری'])

        <form id="date_form">
            <select name="year">
                @for($i= $first_year; $i<= $current_year; $i++)
                    <option value="{{$i}}">{{$i}}</option>
                @endfor
            </select>
            <select name="month">
                @foreach($months as $key => $month)
                    <option value="{{$key}}" {{$current_month == $key ? 'selected': ''}}>{{$month}}</option>
                @endforeach
            </select>
            <button class="btn btn-primary btn-xs" type="submit"><i class="fa fa-refresh"></i></button>
        </form>
        <br>
        <form id="interval_form" action="{{ route('intervals.store') }}" method="post">
            {{ csrf_field() }}
        <table class="table table-responsive table-striped">
            <tr>
                <th>#</th>
                <th>نام دارنده حساب</th>
                <th>شماره حساب</th>
                <th>مبلغ پرداختی</th>
                <th>وضعیت پرداخت</th>
                <th><input type="checkbox" id="check_all" /></th>
            </tr>
            @foreach($accounts as $account)
                <tr>
                    <td>{{$loop->index + 1}}</td>
                    <td class="text-center" id="{{ $account->id }}">{{ $account->user->fullname() }}</td>
                    <td class="text-center">{{ $account->account_number }}</td>
                    <td class="text-center">{{ $amount }} تومان</td>
                    <td class="text-center">
                        @if(in_array($account->id , $payedAccountIds->toArray()))
                            <ul class="dropdown">
                                <button class="btn btn-success dropdown-toggle" style="font-size: 10px" id="menu1" type="button" data-toggle="dropdown">پرداخت شد</button>
                            </ul>
                            {{--<span class="btn btn-success" style="padding:3px;font-size: 11px">پرداخت شد</span>--}}
                        @endif
                    </td>
{{--                        <td class="text-center">{{ in_array($account->id, $payedAccountIds->toArray()) ? 'are' : 'na' }}</td>--}}
                    <td class="setting-icons text-center col-xs-1">
                        <input type="checkbox" name="{{$account->id}}" {{ in_array($account->id , $payedAccountIds->toArray()) ? 'checked disabled="disabled"' : '' }}>
                    </td>
                </tr>
            @endforeach
        </table>
            <hr>
            <button type="button" id="pay_btn" class="btn btn-primary">ثبت پرداختی</button>
    @endcomponent

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('#pay_btn').click(function () {
                $('#date_form').find('select').each(function () {
                    $('#interval_form').append($(this));
                });
                $('#interval_form').submit();
            });

            $('#check_all').click(function() {
                if(this.checked) {
                    // Iterate each checkbox
                    $(':checkbox').each(function() {
                        if ($(this).attr('disabled') !== 'disabled')
                            this.checked = true;
                    });
                } else {
                    $(':checkbox').each(function() {
                        if ($(this).attr('disabled') !== 'disabled')
                            this.checked = false;
                    });
                }
            });
        })
    </script>
@endsection

