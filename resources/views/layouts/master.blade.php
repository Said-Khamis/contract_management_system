<!doctype html >
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none" data-preloader="disable">

<head>
    <meta charset="utf-8" />
    <title>@yield('title') | FMS</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Foreign Management System" name="description" />
    <meta content="The Ministry of Foreign Affairs and East African Cooperation" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('build/images/favicon.ico')}}">
    @include('layouts.head-css')

    @livewireStyles

</head>

@section('body')
    @include('layouts.body')
    @include('sweetalert::alert')
@show
    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('layouts.topbar')
        @include('layouts.sidebar')
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
{{--            @include('layouts.modal')--}}
            @include('layouts.footer')
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    @include('components._general_modal')

    <!-- JAVASCRIPT -->
    @livewireScripts
    @include('layouts.vendor-scripts')
    @stack('java-scripts')
</body>

</html>
