<header class="main-header">
    <!-- Logo -->
    <a href="{{ route('home') }}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini fa fa-home" style="margin-top: 15px"></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>صفحه نخست</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->

                <li style="color: white;margin-top: 7px">
                    <i>{{ Auth::User()->username }}</i>
                    <img src="{{ asset('image/1.jpg') }}" style="width: 35px;height: 35px;border-radius: 50%">
                </li>

                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        {{--<img src="{{asset(Auth::user()->getAvatar())}}" class="user-image" alt="User Image">--}}
                        {{--<span class="hidden-xs">{{ Auth::user()->f_name }}</span>--}}
                    </a>
                    <ul class="dropdown-menu">
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="row">
                                <div class="col-xs-6 text-center">
                                    <a href="#">{{__('my_profile')}}
                                        <br/>
                                        <i class="fa fa-user"></i>
                                    </a>
                                </div>
                                <div class="col-xs-6 text-center">
                                    <a id="change_user_role_btn" href="#">{{__('change_user_role')}}
                                        <br/>
                                        <i class="fa fa-wrench"></i>
                                    </a>
                                </div>
                            </div>
                            <!-- /.row -->
                        </li>
                        <li class="user-footer">
                            <a class="btn btn-default" onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{__('exit')}}&nbsp;<i class="fa fa-sign-out"></i></a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
                {{--@if(hasCurrentRoleIn(['admin', 'adminAssistant']))
                    <li>
                        <a href="{{route('backend.system_options')}}"><i class="fa fa-gears"></i></a>
                    </li>
                @else
                    <li style="margin-right: 50px"></li>
                @endif--}}
            </ul>
        </div>
    </nav>
</header>