<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>
       <title>Error</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">

        @include("layouts.head-css")

        <style>
            body {
                font-family: 'Nunito', sans-serif;
            }
        </style>
    </head>

    <body>

        <div class="auth-page-wrapper pt-5">
            <!-- auth page bg -->
            <div class="auth-one-bg-position auth-one-bg" id="auth-particles">
                <div class="bg-overlay"></div>
                <div class="shape">
                    <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1440 120">
                        <path d="M 0,36 C 144,53.6 432,123.2 720,124 C 1008,124.8 1296,56.8 1440,40L1440 140L0 140z"></path>
                    </svg>
                </div>
            </div>

            <div class="auth-page-content mt-5">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="text-center pt-4 ">
                                <div class="">
                                    <img src="{{ asset("build/images/error.svg") }}" alt="" class="error-basic-img move-animation">
                                </div>
                                <div class="mt-n4">
                                    <h1 class="display-1 fw-medium"> @yield('code') </h1>
                                    <h3 class="text-uppercase"> @yield('message') </h3>
                                    <p class="text-muted mb-4" style="font-size: 17px;">@yield("message_desc")</p>
                                    <a href="{{ redirect()->back()->getTargetUrl() }}" class="btn btn-primary"><i class="mdi mdi-arrow-bottom-left-thick me-2"></i>Back</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

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

        </div>
    </body>


</html>
