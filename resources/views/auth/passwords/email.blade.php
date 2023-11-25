@extends('layouts.master-without-nav')
@section('title')
    Login
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
                            <p class="mt-3 fs-15 fw-medium">{{-- Premium Admin & Dashboard Template--}}</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-5">
                        <div class="card mt-4">
                            <div class="card-body">
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <!-- /Logo -->
                                <h4 class="mb-2">Forgot Password ?</h4>
                                <p class="mb-4">Enter your email and we'll send you instructions to reset your password</p>
                                <form id="formAuthentication" class="mb-3" action="{{ route('password.email') }}" method="POST">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="email" class="">Email</label>
                                        <input
                                            id="email"
                                            type="text"
                                            class="form-control @error('email') is-invalid @enderror"
                                            name="email" value="{{ (Auth::user())?Auth::user()->email:old('email') }}"
                                            autocomplete="email"
                                            placeholder="Enter your email"
                                            autofocus
                                            required />
                                        @error('email')
                                        <span id="errorMessage" class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                                        @enderror
                                    </div>
                                    <button class="btn btn-success d-grid w-100">
                                        {{ __('Send Password Reset Link') }}
                                    </button>
                                </form>
                                <div class="text-center">
                                    <a href="{{ url("/") }}" class="d-flex align-items-center justify-content-center">
                                        <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                                        Back to login
                                    </a>
                                </div>
                            </div>
                        </div>
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
                            <p class="mb-0 text-muted">&copy; <script>document.write(new Date().getFullYear())</script> Ministry of Foreign Affairs and East Africa Cooperation.  Tanzania</p>
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

@endsection







