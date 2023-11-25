<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-topbar="light" data-sidebar-image="none">

    <head>
    <meta charset="utf-8" />
    <title>@yield('title') | FMS </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Contracts Management System" name="description" />
    <meta content="Shaban Nzogo" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('build/images/favicon.ico')}}">
        @include('layouts.head-css')
  </head>
    @yield('body')

    @yield('content')

    @include('layouts.vendor-scripts')
    </body>
</html>
