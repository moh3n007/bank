@php
    $crumbs = [
        ['name'=> 'لیست وام ها', 'url'=> route('loans.list')],
        ['name' => $loan->family->name , 'url'=> '#']
    ];

$now = date('Y-m-d');
$notPayCount = DB::table('payments')->where('loan_id',$loan->id)->where('pay_date',Null)->count();
$payAll = DB::table('payments')->where('loan_id',$loan->id)->count();
$payCount = $payAll - $notPayCount;
$percentPay = (int)ceil($payCount/$payAll*100);
//dd($percentPay);
@endphp

@extends('layouts.master')

@section('content')
    @component('forms.panel', ['title'=>'نمایش وام'])

        <div class="row">
            <div class="col-md-8 col-md-push-2">

                <br>
                <div style="background-color: #e8e8e8;border-radius: 3px;height: 50px; padding-top: 15px; padding-right: 9px">
                    <span>مقدار وام :</span>
                    <span>{{ $loan->amount }} تومان</span>
                </div>
                <br>
                <hr>
                <span>نمودار پیشرفت پرداخت اقساط وام:</span>
                <br>
                <br>
                <div class="progress">
                    <div class="progress-bar progress-bar-striped active" role="progressbar" aria-valuenow="{{ $percentPay }}" aria-valuemin="0" aria-valuemax="100" style="width:{{$percentPay}}%">
                        {{ $percentPay }}%
                    </div>
                </div>

                <hr>

                <form action="{{ route('loans.payment') }}" method="post">
                    {{ csrf_field() }}
                    <table class="table table-responsive table-striped">
                        <tr>
                            <th>#</th>
                            <th>سررسید</th>
                            <th>مبلغ قسط</th>
                            <th>وضعیت پرداخت</th>
                            <th>تاریخ پرداخت</th>
                        </tr>
                        @foreach($loan->payments as $payment)
                            <tr>
                                <td>{{$loop->index + 1}}</td>
                                <td class="text-center">{{ @jdate($payment->due_date)->format('%d , %B، %Y')}}</td>
                                <td class="text-center">{{ $payment->amount }}</td>
                                <td class="text-center">
                                    @if($payment->pay_date != '')
                                        <span class="btn btn-success" style="padding:3px;font-size: 11px">پرداخت شد</span>
                                    @elseif($payment->due_date < $now)
                                        <span class="btn btn-warning" style="padding:3px;font-size: 11px;width: 60px;">معوقه</span>
                                    @endif
                                </td>
                                <td class="text-center">@if($payment->pay_date != ''){{ jdate($payment->pay_date)->format('%d , %B، %Y') }}@endif</td>
                                <td class="text-center">
                                    @if($payment->pay_date == '')
                                        <button type="submit" name="{{$payment->id}}" class="btn btn-primary" style="padding:3px;font-size: 11px;width: 60px;" onclick="return checkDelete()">پرداخت</button>
                                    @endif
                                </td>

                            </tr>
                        @endforeach
                    </table>
                </form>

                <br>
                <hr>

            </div>
        </div>

    @endcomponent
@endsection

@section('script')
    <script language="JavaScript" type="text/javascript">
        function checkDelete(){
            return confirm('آیا مطمئن هستید؟');
        }
    </script>
@endsection
