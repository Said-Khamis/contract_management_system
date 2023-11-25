@extends('layouts.master')
@section( 'title','User Profile')
@section('content')
    @component('components.breadcrumb')
        @slot('sub_title')
            Users
        @endslot
        @slot('action')
            Profile
        @endslot
    @endcomponent
    <div class="row">
        <div class="col">
            @include('error')
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                <i class="fas fa-home"></i>
                                Personal Details
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                <i class="far fa-user"></i>
                                Change Password
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                            <form action="{{route('user.profile.store')}}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="firstName" class="form-label">First
                                                Name</label>
                                            <input name="firstName" required type="text" class="form-control" id="firstName" placeholder="Enter your first name" value="{{Auth::user()->first_name}}">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="middleName" class="form-label">Middle
                                                Name</label>
                                            <input name="middleName" type="text" class="form-control" id="middleName" placeholder="Enter your middle name" value="{{Auth::user()->middle_name}}">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="lastName" class="form-label">Last
                                                Name</label>
                                            <input name="lastName" required type="text" class="form-control" id="lastName" placeholder="Enter your last name" value="{{Auth::user()->last_name}}">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label for="email" class="form-label">Email
                                                Address</label>
                                            <input name="email" required type="email" class="form-control" id="email" placeholder="Enter your email" value="{{Auth::user()->email}}">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <label for="institution" class="form-label">Institution
                                                </label>
                                            <input readonly type="text" class="form-control" id="institution" value="{{Auth::user()->institution->name}}" />
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="reset" class="btn btn-soft-secondary">Cancel</button>
                                            <button type="submit" class="btn btn-primary">Updates</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane" id="changePassword" role="tabpanel">
                            <form action="{{route('user.password.update')}}" method="POST">
                                @csrf
                                <div class="row g-2">
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="oldPassword" class="form-label">Old
                                                Password*</label>
                                            <input required name="oldPassword" type="password" class="form-control" id="oldPassword" placeholder="Enter current password">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="newPassword" class="form-label">New
                                                Password*</label>
                                            <input required name="newPassword" type="password" class="form-control" id="newPassword" placeholder="Enter new password">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4">
                                        <div>
                                            <label for="confirmPassword" class="form-label">Confirm
                                                Password*</label>
                                            <input required name="confirmPassword" type="password" class="form-control" id="confirmPassword" placeholder="Confirm password">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="mb-3">
                                            <a href="{{route('password.request')}}" class="link-primary text-decoration-underline">Forgot
                                                Password ?</a>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-12">
                                        <div class="text-end">
                                            <button type="submit" class="btn btn-primary">Change
                                                Password</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
{{--                            <div class="mt-4 mb-3 border-bottom pb-2">--}}
{{--                                <div class="float-end">--}}
{{--                                    <a href="javascript:void(0);" class="link-secondary">All Logout</a>--}}
{{--                                </div>--}}
{{--                                <h5 class="card-title">Login History</h5>--}}
{{--                            </div>--}}
{{--                            <div class="d-flex align-items-center mb-3">--}}
{{--                                <div class="flex-shrink-0 avatar-sm">--}}
{{--                                    <div class="avatar-title bg-light text-primary rounded-3 fs-18">--}}
{{--                                        <i class="ri-smartphone-line"></i>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="flex-grow-1 ms-3">--}}
{{--                                    <h6>iPhone 12 Pro</h6>--}}
{{--                                    <p class="text-muted mb-0">Los Angeles, United States - March 16 at--}}
{{--                                        2:47PM</p>--}}
{{--                                </div>--}}
{{--                                <div>--}}
{{--                                    <a href="javascript:void(0);" class="link-secondary">Logout</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="d-flex align-items-center mb-3">--}}
{{--                                <div class="flex-shrink-0 avatar-sm">--}}
{{--                                    <div class="avatar-title bg-light text-primary rounded-3 fs-18">--}}
{{--                                        <i class="ri-tablet-line"></i>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="flex-grow-1 ms-3">--}}
{{--                                    <h6>Apple iPad Pro</h6>--}}
{{--                                    <p class="text-muted mb-0">Washington, United States - November 06--}}
{{--                                        at 10:43AM</p>--}}
{{--                                </div>--}}
{{--                                <div>--}}
{{--                                    <a href="javascript:void(0);" class="link-secondary">Logout</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="d-flex align-items-center mb-3">--}}
{{--                                <div class="flex-shrink-0 avatar-sm">--}}
{{--                                    <div class="avatar-title bg-light text-primary rounded-3 fs-18">--}}
{{--                                        <i class="ri-smartphone-line"></i>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="flex-grow-1 ms-3">--}}
{{--                                    <h6>Galaxy S21 Ultra 5G</h6>--}}
{{--                                    <p class="text-muted mb-0">Conneticut, United States - June 12 at--}}
{{--                                        3:24PM</p>--}}
{{--                                </div>--}}
{{--                                <div>--}}
{{--                                    <a href="javascript:void(0);" class="link-secondary">Logout</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                            <div class="d-flex align-items-center">--}}
{{--                                <div class="flex-shrink-0 avatar-sm">--}}
{{--                                    <div class="avatar-title bg-light text-primary rounded-3 fs-18">--}}
{{--                                        <i class="ri-macbook-line"></i>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="flex-grow-1 ms-3">--}}
{{--                                    <h6>Dell Inspiron 14</h6>--}}
{{--                                    <p class="text-muted mb-0">Phoenix, United States - July 26 at--}}
{{--                                        8:10AM</p>--}}
{{--                                </div>--}}
{{--                                <div>--}}
{{--                                    <a href="javascript:void(0);" class="link-secondary">Logout</a>--}}
{{--                                </div>--}}
{{--                            </div>--}}
                        </div>
                        <!--end tab-pane-->
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
@endsection
