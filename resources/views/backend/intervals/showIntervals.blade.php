@php
    $crumbs = [
        ['name'=> 'مشاهده پرداختی ماهیانه', 'url'=> '#']
    ];

@endphp

@extends('layouts.master')

@section('content')

    @component('forms.panel', ['title'=>'لیست پرداختی جاری'])

        <form action="{{ route('intervals.store') }}" method="post">
            {{ csrf_field() }}
            <table class="table table-responsive table-striped">
                <tr>
                    <th>#</th>
                    <th>نام دارنده حساب</th>
                    <th>شماره حساب</th>
                    <th>مبلغ پرداختی</th>
                    <th>وضعیت پرداخت</th>
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
                                    <button class="btn btn-success dropdown-toggle" style="font-size: 10px" id="menu1" type="button" data-toggle="dropdown">پرداخت شد
                                        <span class="caret"></span></button>
                                    <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                                        <li role="presentation"><a role="menuitem" tabindex="-1" href="#">تاریخ پرداخت :{{ \App\Models\Interval::where('account_id',$account->id)->get() }}</a></li>
                                    </ul>
                                </ul>
                                {{--<span class="btn btn-success" style="padding:3px;font-size: 11px">پرداخت شد</span>--}}
                            @endif
                        </td>
{{--                        <td class="text-center">{{ in_array($account->id, $payedAccountIds->toArray()) ? 'are' : 'na' }}</td>--}}
                        <td hidden>
                            <input type="checkbox" name="{{$account->id}}" id="checkbox" checked>
                        </td>
                    </tr>
                @endforeach
            </table>
            <br>
            <hr>
            <button type="submit" class="btn btn-primary">گام بعدی</button>
        </form>
    @endcomponent

@endsection

@section('script')
    <script>
        $(document).ready(function () {
            // check partial isset
            @if(session()->exists('partial_view'))
            if($('#'+'{{session('partial_view')}}').length > 0) {
                $('.config-container').css('display', 'none');
                $('#' + '{{session('partial_view')}}').fadeIn();
                $('.config-controller li').removeClass('active');
                $('a[href="#{{session('partial_view')}}"]').closest('li').addClass('active');
            }
            @endif
            // find any form error
            if($('.form-group.has-error').length !== 0){
                $('.config-container').css('display','none');
                $('.form-group.has-error').closest('.config-container').slideDown();
            }
            // go to partial by click
            $('.config-controller a').click(function (e) {
                e.preventDefault();
                $('.config-controller li').removeClass('active');
                $(this).closest('li').addClass('active');
                //
                var hash = $(this).attr('href').replace(/^#/, '');
                $('.config-container').css('display','none');
                $('#'+hash).fadeIn();
                // set session
                $.ajax({
                    url: "{{url('panel/ajax/setPartialPage')}}",
                    'type': 'get',
                    data: { partial: hash },
                    success: function(data){
                        console.log(data);
                    }
                });
            });
            ////////

            $(".dropdown-toggle").dropdown();

        });
    </script>
@endsection
