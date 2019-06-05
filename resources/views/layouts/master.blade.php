<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} | @yield('title')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('admin/css/bootstrap-theme.css')}}">

    <!-- Bootstrap rtl -->
    <link rel="stylesheet" href="{{asset('admin/css/rtl.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('admin/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('admin/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Select2 -->
    <link rel="stylesheet" href="{{asset('admin\bower_components\select2\dist\css\select2.min.css')}}">

@yield('style')
@stack('style')

<!-- Theme style -->
    <link rel="stylesheet" href="{{asset('admin/css/AdminLTE.css')}}">
    <!-- AdminLTE Skins. We have chosen the skin-blue for this starter
          page. However, you can choose any other skin. Make sure you
          apply the skin class to the body tag so the changes take effect. -->
    <link rel="stylesheet" href="{{asset('admin/css/skins/skin-purple.css')}}">
    <link rel="stylesheet" href="{{asset('admin/css/style.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

    <!-- Main Header -->
@include('layouts.partials.top-menu')

<!-- right side column. contains the logo and sidebar -->
@include('layouts.partials.right-menu')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                @yield('title')
                <small>@yield('description')</small>
            </h1>
            @include('layouts.partials.breadcrumb', ['crumbs'=> $crumbs?? [] ])

        </section>

        <!-- Main content -->
        <section class="content container-fluid">


        @yield('content')

        @include('layouts.partials.messages')

        <!--------------------------
              | Your Page Content Here |
              -------------------------->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Main Footer -->
    <footer class="main-footer text-left">
        <strong>Copyleft &copy; 2017-2020 <a href="{{ url('/') }}">PANEL</a></strong>
    </footer>


</div>
<!-- ./wrapper -->

<!-- REQUIRED JS SCRIPTS -->
<!-- jQuery 3 -->
<script src="{{ asset('admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('admin/js/adminlte.min.js') }}"></script>


<script>
  $(function () {
    $('#admin-error-modal').modal('show');
    $('[data-toggle="tooltip"]').tooltip({ container: 'body'});
    $('.tooltip-action').tooltip();
    $('[data-toggle="popover"]').popover({ container: 'body'});

    // Menu navigation
    var url = window.location;
    console.log(url);
    $('ul.sidebar-menu a').filter(function() {
      return this.href == url.href;
    }).closest('li').addClass('active')
      .closest('.treeview-menu').css('display', 'block')
      .closest('.treeview').addClass('menu-open');
  })
</script>



@yield('script')
@stack('script')

</body>
</html>