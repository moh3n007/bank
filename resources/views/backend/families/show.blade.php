@php
    $crumbs = [
        ['name'=> 'لیست گروه ها', 'url'=> route('families.list')],
        ['name' => $family->name , 'url'=> '#']
    ]
@endphp

@extends('layouts.master')

@section('content')

        <div class="row">
            <div class="col-md-3">
                <div class="box box-primary">
                    <div class="box-body box-profile">
                        <p class="text-center">گروه</p>
                        <h3 class="profile-username text-center">{{$family->name}}</h3>
                    </div>
                    <hr>
                    <ul class="nav nav-pills nav-stacked config-controller">
                        <li class="active">
                            <a href="#base_info">اطلاعات پایه
                                <span class="pull-left"><i class="fa fa-info"></i></span>
                            </a>
                        </li>
                        <li>
                            <a href="#members">اعضاء گروه
                                <span class="pull-left"><i class="fa fa-users"></i></span>
                            </a>
                        </li>
                        <li>
                            <a href="#loan_create">ایجاد وام جدید
                                <span class="pull-left"><i class="fa fa-plus-square"></i></span>
                            </a>
                        </li>
                        <li>
                            <a href="#show_loan">وام های اختصاص یافته
                                <span class="pull-left"><i class="fa fa-check-circle"></i></span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="col-md-9">

                <div class="config-container" style="display: block;" id="base_info">
                    @include('backend.families.partials.base_info')
                </div>

                <div class="config-container" id="members">
                    @include('backend.families.partials.members')
                </div>

                <div class="config-container" id="loan_create">
                    @include('backend.families.partials.loan_create')
                </div>

                <div class="config-container" id="show_loan">
                    @include('backend.families.partials.show_loan')
                </div>

            </div>
        </div>

        {{--<div class="form-group">--}}
            {{--<select name="user_list" id="user_list" class="form-control">--}}
                {{--@foreach($users as $user)--}}
                    {{--<option value="{{ $user->id }}">{{ $user->fullname() }}</option>--}}
                {{--@endforeach--}}
            {{--</select>--}}
        {{--</div>--}}

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

        });
    </script>
@endsection

@push('style')
<link rel="stylesheet" href="{{asset('admin/bower_components/select2/dist/css/select2.min.css')}}">
@endpush

@push('script')
<script src="{{ asset('admin/bower_components/select2/dist/js/select2.min.js') }}"></script>
<script>
  $(document).ready(function () {
    $('#account_id').select2();
  $(".editable-text").editable("save.php");
  })

</script>
@endpush

