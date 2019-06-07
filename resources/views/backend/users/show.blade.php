@php
    $crumbs = [
        ['name'=> 'لیست اعضاء', 'url'=> route('users.list')],
        ['name'=> $user->fullname(), 'url'=> '#'],
    ]
@endphp

@extends('layouts.master')

@section('content')

    <div class="row">
        <div class="col-md-3">
            <div class="box box-primary">
                <div class="box-body box-profile">
                    <img class="profile-user-img img-responsive img-circle" src="{{asset('image/avatar/avatar.png')}}{{--{{(hasAvatar($user->id)? asset('images/avatar/'.$user->id.'.jpg?'.str_random(5)) : asset('admin/img/avatar.png') )}}--}}" alt="User profile picture">

                    <h3 class="profile-username text-center">{{$user->fullname()}}</h3>

                    <p class="text-muted text-center">زمان آخرین ورود {{jdate($user->last_login)->format('%d %B، %Y')}}</p>

                </div>
                <hr>
                <ul class="nav nav-pills nav-stacked config-controller">
                    <li class="active">
                        <a href="#base_info">اطلاعات پایه
                            <span class="pull-left"><i class="fa fa-user"></i></span>
                        </a>
                    </li>
                    <li>
                        <a href="#accounts">حساب ها
                            <span class="pull-left"><i class="fa fa-dollar"></i></span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="col-md-9">

            <div class="config-container" style="display: block;" id="base_info">
                @include('backend.users.partials.base_info')
            </div>

            <div class="config-container" id="accounts">
                @include('backend.users.partials.accounts')
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
