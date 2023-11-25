@extends('layouts.master-without-nav')
@section('title')
    Create Password Form
@endsection
@section('content')

    <style>
        table tr td a {
            color: black; /* or any other default color you want */
            text-decoration: none; /* remove underline by default */
        }

        /* Styles on mouse hover */
        table tr td a:hover {
            color: blue; /* change text color to blue */
            text-decoration: underline; /* add underline on hover */
        }
    </style>

    <div class="auth-page-wrapper">

        <!-- auth page bg -->
        <div class="auth-one-bg-position auth-one-bg"  id="auth-particles">
            <div class="bg-overlay"></div>
            <div class="shape">
                <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                    <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                </svg>
            </div>
        </div>

        <div class="auth-page-content">
            <div class="container-fluid">
                <div class="row pt-4">
                    <div class="col-lg-2 col-md-2 col-sm-12" style="width: 16.6667%;">
                        <img src="{{ asset('src/arm.png') }}" class="float-lg-end" style="height: 90px; width: 88px;"
                             alt="">
                    </div>

                    <div class="col-lg-8 col-md-8 col-sm-12" style="width: 66.6667%;">
                        <div class="text-center">
                            <h5 class="text-center font-weight-bold" style="color: dodgerblue; font-size: 18px;">THE
                                UNITED REPUBLIC OF TANZANIA</h5>
                            <h5 class="text-center font-weight-bold" style="color: dodgerblue; font-size: 18px;">
                                Ministry of Constitutional and Legal Affairs</h5>
                            <h5 class="text-center font-weight-bold"
                                style="color: dodgerblue; font-size: 18px;">{{ getTitle() }}</h5>
                        </div>
                    </div>

                    <div class="col-lg-2 col-md-2 col-sm-12" style="width: 16.6667%;">
                        <img src="{{ asset('src/logo.png') }}" class="float-lg-start" style="height: 90px; width: 88px;" alt="">
                    </div>
                </div>
                <div class="container d-flex justify-content-center align-items-center">
                    <div class="my-5  col-md-4 col-sm-12 col-lg-4">
                        <div class="card">
                            <div class="card-body">
                                <!-- Logo -->
                                @if (session('status'))
                                    <div class="alert alert-success" role="alert">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                <!-- /Logo -->
                                <h4 class="mb-2">Create Password</h4>
                                <form id="formAuthentication" class="mb-3" action="{{ route('password.store') }}" method="POST">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token }}">
                                    <div class="mb-3">
                                        <label for="email" class="">Email</label>
                                        <input id="email" type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" autocomplete="email" placeholder="Enter your email" autofocus required />
                                        @error('email')
                                        <span class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></span>
                                        @enderror
                                        @if(session('error'))
                                            <span class="text-danger" style="font-size: 12px">{{ session('error') }}</span>
                                        @endif
                                    </div>

                                    <div class="mb-3">
                                        <label for="password" class="">{{ __('Password') }}</label>
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                                        @error('password')
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label for="password-confirm" class="">{{ __('Confirm Password') }}</label>
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                                    </div>
                                    <button type="submit" class="btn btn-primary  d-grid w-100 mb-3">{{ __('Create Password') }}</button>
                                    <div class="text-center">
                                        <a href="{{ url("/") }}">
                                            <i class="bx bx-chevron-left scaleX-n1-rtl bx-sm"></i>
                                            Back to login
                                        </a>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

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
