@php
    $crumbs = [
        ['name'=> 'لیست وام ها', 'url'=> route('loans.list')]
    ]
@endphp

@extends('layouts.master')

@section('content')
    @component('forms.panel', ['title'=>'لیست وام ها'])

    <table class="table table-responsive table-striped">
        @if(is_null($loans ))
            <span style="color: red;">هیچ وامی برای نمایش وجود ندارد</span>
        @else
            <tr>
                <th>#</th>
                <th>نام خانواده</th>
                <th>مقدار وام</th>
                <th>تاریخ شروع</th>
                <th>تاریخ پایان</th>
                <th></th>
            </tr>
            @foreach($loans as $loan)
                <tr>
                    <td>{{$loop->index + 1}}</td>
                    <td class="text-center">{{ @$loan->family->name }}</td>
                    <td class="text-center">{{ $loan->amount }}</td>
                    <td class="text-center">{{ jdate($loan->start_date)->format('%B %d، %Y') }}</td>
                    <td class="text-center">{{ jdate($loan->finish_date)->format('%B %d، %Y') }}</td>
                    <td class="setting-icons text-center col-xs-1">
                        <a href="{{ route('loans.show' , [$loan->id]) }}" class="btn btn-xs btn-primary" data-toggle="tooltip" title="نمایش کامل اطلاعات">
                            <i class="fa fa-info"></i>
                        </a>
                        <a href="{{ route('loans.delete' , [$loan->id]) }}" class="btn btn-xs btn-danger" onclick="return checkDelete()" data-toggle="tooltip" title="حذف وام">
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
