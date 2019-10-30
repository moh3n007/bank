@php
    $crumbs = [
        ['name'=> 'اقساط ماهیانه', 'url'=> route('loans.payments')]
    ];

@endphp

@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <p class="text-center">مدیریت</p>
                    <h3 class="profile-username text-center">اقساط وام</h3>
                </div>
                <hr>
                <ul class="nav nav-pills nav-stacked config-controller">
                    <li class="active">
                        <a href="#dueDate_list">اقساط جاری
                            <span class="pull-left"><i class="fa fa-info"></i></span>
                        </a>
                    </li>
                    <li >
                        <a href="#pastDate_list">اقساط معوقه
                            <span class="pull-left"><i class="fa fa-info"></i></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-md-9">

            <div class="config-container" style="display: block;" id="dueDate_list">
                @include('backend.loans.partials.dueDate_list')
            </div>

            <div class="config-container"  id="pastDate_list">
                @include('backend.loans.partials.pastDate_list')
            </div>


        </div>
    </div>
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
                    url: "{{url('ajax/setPartialPage')}}",
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
