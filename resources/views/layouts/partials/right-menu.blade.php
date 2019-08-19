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
            <li class="header">منوی اصلی</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user"></i>
                    <span>مدیریت اعضاء</span>
                    <span class="pull-left-container"><i class="fa fa-angle-right pull-left"></i></span>
                </a>
                <ul class="treeview-menu">
                <li><a href="{{route('users.create')}}"><i class="fa fa-user-plus"></i><span>ثبت اعضاء</span></a></li>
                <li><a href="{{route('users.list')}}"><i class="fa fa-list-ol"></i><span>لیست اعضاء</span></a></li>
                </ul>
            </li>
            <li class="header"></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>مدیریت گروه ها</span>
                    <span class="pull-left-container"><i class="fa fa-angle-right pull-left"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('families.create') }}"><i class="fa fa-user-plus"></i><span>ثبت گروه</span></a></li>
                    <li><a href="{{ route('families.list') }}"><i class="fa fa-list-ol"></i><span>لیست گروه ها</span></a></li>
                </ul>
            </li>
            <li class="header"></li>
            <li class="treeview">
            <a href="#">
            <i class="fa fa-money"></i>
            <span>مدیریت حساب</span>
            <span class="pull-left-container"><i class="fa fa-angle-right pull-left"></i></span>
            </a>
            <ul class="treeview-menu">
                    <li><a href="{{ route('accounts.create') }}"><i class="fa fa-plus-square"></i><span>ثبت حساب</span></a></li>
                    <li><a href="{{ route('accounts.list') }}"><i class="fa fa-list-ol"></i><span> لیست حساب ها</span></a></li>
                </ul>
            </li>
            <li class="header"></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cc"></i>
                    <span>مدیریت وام ها</span>
                    <span class="pull-left-container"><i class="fa fa-angle-right pull-left"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('loans.list') }}"><i class="fa fa-list-ol"></i><span>لیست وام ها</span></a></li>
                    <li><a href="{{ route('loans.payments') }}"><i class="fa fa-credit-card"></i><span>اقساط ماهیانه</span></a></li>
                </ul>
            </li>
            <li class="header"></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cc"></i>
                    <span>مدیریت پرداخت ماهیانه</span>
                    <span class="pull-left-container"><i class="fa fa-angle-right pull-left"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{ route('intervals.show') }}"><i class="fa fa-list-ol"></i><span>لیست پرداخت</span></a></li>
                    <li><a href="{{ route('intervals.history') }}"><i class="fa fa-list-ol"></i><span>تاریخچه پرداخت</span></a></li>
                </ul>
            </li>
            <li class="header"></li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user-circle-o text-yellow"></i> 
                    <span>پروفایل من</span>
                    <span class="pull-left-container"><i class="fa fa-angle-right pull-left"></i></span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#"><i class="fa fa-user"></i><span>تغییر پروفایل</span></a></li>
                    <li><a href="#"><i class="fa fa-key"></i><span>تنظیمات ورود</span></a></li>
                </ul>
            </li>
            <li>
                <a href="{{ route('systemOption.option') }}">
                    <i class="fa fa-gears"></i> <span>تنظیمات</span>
                </a>
            </li>
            <li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    {{ csrf_field() }}
                </form>
                <a href="#" onclick="event.preventDefault();
                                       document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out text-red"></i> <span>خروج</span>
                </a>
            </li>

        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>