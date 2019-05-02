<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

       {{-- <div class="user-role-in-menu">
            <span>{{__('user_role')}} :</span> {{session('user.roles')[session('user.current_role')]}}
        </div>
--}}
        {{--<!-- search form (Optional) -->--}}
        {{--<form action="#" method="get" class="sidebar-form">--}}
            {{--<div class="input-group">--}}
                {{--<input type="text" name="q" class="form-control" placeholder="{{__('search')}}">--}}
                {{--<span class="input-group-btn">--}}
              {{--<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>--}}
              {{--</button>--}}
            {{--</span>--}}
            {{--</div>--}}
        {{--</form>--}}
        {{--<!-- /.search form -->--}}

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">{{__('main_menu')}}</li>
            <!-- Optionally, you can add icons to the links -->

            {{--@if(hasCurrentRole('admin'))--}}
                {{--@include('menus.admin')--}}
                {{--<li class="header">{{__('app_menu')}}</li>--}}
                {{--@include('menus.app-admin')--}}
            {{--@endif--}}

            <li>
                <a href="#">
                    <i class="fa fa-user-circle-o text-yellow"></i> 
                    <span>{{__('edit_profile')}}</span>
                </a>
            </li>
            <li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
                <a href="#" onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out text-red"></i> <span>{{__('logout')}}</span>
                </a>
            </li>

        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>