<!doctype html>
<html lang="en">
<head>
    <meta name="description" content="Secret Correa Affiliate Membership">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>@yield('title') | Secret Correa</title>

    <!-- Main CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('theme/css/main.css') }}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body class="app sidebar-mini rtl">
    {{--Navbar--}}
    <header class="app-header">
        {{--Logo/Name view--}}
        <a class="app-header__logo" href="/">Secret Correa</a>
        {{--Sidebar toggle button--}}
        <a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>
        {{--Navbar top right menu--}}
        @include('master.includes.navTop')
    </header>

    {{--Left Side Menu bar--}}
    @include('master.includes.leftSideMenu')

    @yield('content')

    <!-- Essential javascripts for application to work-->
    <script src="{{ asset('theme/js/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('theme/js/popper.min.js') }}"></script>
    <script src="{{ asset('theme/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('theme/js/main.js') }}"></script>

    <!-- The javascript plugin to display page loading on top-->
    <script src="{{ asset('theme/js/plugins/pace.min.js') }}"></script>

    <!-- Page specific javascripts-->
    @yield('custom-js')
</body>
</html>