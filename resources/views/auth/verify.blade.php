@extends('layouts.master-without-nav')
@section('title')
    Email Verification Notice
@endsection
@section('content')
    <div class="auth-page-wrapper pt-5">
        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg"  id="auth-particles">
            <div class="bg-overlay"></div>

            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <!-- auth page content -->
        <div class="auth-page-content">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="text-center mt-sm-5 mb-4 text-white-50">
                            <div>
                                {{--                                <a href="index" class="d-inline-block auth-logo">--}}
                                {{--                                    <img src="{{ URL::asset('build/images/flags/tanzania-flag.jpg')}}" alt="" height="200">--}}
                                {{--                                </a>--}}
                            </div>
                            <p class="mt-3 fs-15 fw-medium">{{-- Premium Admin & Dashboard Template--}}</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card mt-4">

                <div class="card-body p-4">
                    <div class="mb-4">
                        <div class="avatar-lg mx-auto">
                            <div class="avatar-title bg-light text-primary display-5 rounded-circle">
                                <i class="ri-mail-line"></i>
                            </div>
                        </div>
                    </div>

                    <div class="p-2 mt-4">
                        <div class="text-muted text-center mb-4 mx-lg-3">
                            <h4 class="">Verify Your Email</h4>
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    A fresh verification link has been sent to your email address {{$email}}
                                </div>
                            @endif
                            <p>
                                Before proceeding, please check your registered email for a verification link.
                            </p>
                        </div>

                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->

            <div class="mt-4 text-center">
                <p class="mb-0">Didn't receive verification email?
                    <a
                        href="javascript:void(0)"
                        class="fw-semibold text-primary text-decoration-underline"
                        onclick="event.preventDefault(); document.getElementById('resend-form').submit();">
                        Click here to Resend
                    </a>
                </p>
            </div>
            <form id="resend-form" action="{{ route('verification.send') }}" method="POST" class="d-none">
                @csrf
            </form>
        </div>
    </div>
    <!-- end row -->
    </div>
    <!-- end container -->
    </div>
    <!-- end auth page content -->

    <!-- footer -->
    <footer class="footer">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center">
                        <p class="mb-0 text-muted">&copy; <script>document.write(new Date().getFullYear())</script> FMS. Developed by Ministry of Foreign Affairs and East Africa Cooperation</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end Footer -->

    </div>
@endsection
@section('script')
    <script src="{{ URL::asset('build/libs/particles.js/particles.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/particles.app.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/password-addon.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/form-validation.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/two-step-verification.init.js') }}"></script>
@endsection

