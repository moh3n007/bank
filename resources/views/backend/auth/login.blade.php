@extends('layouts.blank')

@section('content')
    <div class="login-box">
        <div class="login-logo">
            <b>ورود به مدیریت</b>
        </div>
        <!-- /.login-logo -->
        <div class="login-box-body">
            <p class="login-box-msg">اطلاعات کاربری خود را وارد نمایید</p>
            <form method="POST" action="{{ route('login') }}">
                {{ csrf_field() }}
                <div class="form-group has-feedback {{ $errors->has('username') ? ' has-error' : '' }}">
                    <input id="username" type="text" placeholder="نام کاربری" class="form-control" name="username" value="{{ old('username') }}" required autofocus>
                    <span class="fa fa-user form-control-feedback"></span>
                    @if ($errors->has('username'))
                        <span class="help-block">
                            {{ $errors->first('username') }}
                        </span>
                    @endif
                </div>

                <div class="form-group has-feedback {{ $errors->has('password') ? ' has-error' : '' }}">
                    <input id="password" placeholder="رمز عبور" type="password" class="form-control" name="password" required>
                    <span class="fa fa-unlock-alt form-control-feedback"></span>
                    @if ($errors->has('password'))
                        <span class="help-block">
                            {{ $errors->first('password') }}
                        </span>
                    @endif
                </div>

                <div class="row">
                    <div class="col-xs-12">
                        <div class="checkbox icheck">
                            <label>
                                <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> مرا به خاطر بسپار
                            </label>
                        </div>
                    </div>
                    <!-- /.col -->
                    <div class="col-xs-12">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">ورود</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>

            {{--<a class="btn btn-link" href="{{ route('password.request') }}">--}}
            {{--رمز عبورم را فراموش کرده ام!--}}
            {{--</a><br>--}}

        </div>
        <!-- /.login-box-body -->
    </div>
@endsection

@section('style')
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('admin/plugins/iCheck/square/blue.css')}}">
@endsection

@section('script')
    <!-- iCheck -->
    <script src="{{ asset('admin/plugins/iCheck/icheck.min.js') }}"></script>
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
@endsection
