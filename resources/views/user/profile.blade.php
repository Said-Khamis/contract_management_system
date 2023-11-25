@extends('layouts.app')
@section( 'title', 'Users Profile')
@section('contents')
    <div class="row">
        <div class="col-md-12 text-center">
            <img class="img-thumbnail mb-1 text-center" src="{{asset('img/logo.png')}}" alt="{{$user->name}}">
        </div>
        <div class="col-md-12 mb-4">
            <div class="card shadow-sm {{$user->passwordIsDefault ? 'border-left-warning' : 'border-left-primary'}}">
                <div class="card-body">
                    <h5>
                        User name: {{$user->name}}
                        <span class="float-right">
                            Email: {{$user->email}}
                        </span>
                    </h5>
                    <hr>
                    <h5>
                        Password Type:
                        @if($user->passwordIsDefault)
                            <span class="badge badge-danger">Default</span>
                        @else
                            <span class="badge badge-success">Secure</span>
                        @endif
                        <span class="float-right">
                            Status: {{$user->status}}
                        </span>
                    </h5>
                </div>
            </div>
        </div>
        <div class="col-md-12 mb-4">
            <h4>Change Password</h4>
            <hr>
        </div>
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <form action="/user/change/password" method="post">
                        @csrf
                        <input type="hidden" name="id" value="{{encode($user->id)}}">
                        <div class="row">
                            <div class="col-md-3">
                                <label>Old Password</label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="password" name="old_password" class="form-control"  required autocomplete="new-password">
                                    <small>provide your current password</small>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label> New Password </label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror"  required autocomplete="new-password">
                                    <small>minimum of eight (8) characters</small>
                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-3">
                                <label> Retype Password </label>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required autocomplete="new-password">
                                    <small> repeat your new password </small>
                                </div>
                                <input type="submit" class="btn btn-primary" value="Reset Password">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

