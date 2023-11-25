@extends('layouts.master')
@section( 'title','User Edit')
@section('content')

    <div class="content px-3">
        <div class="card">
            <div class="card-header py-3">
                <span style="font-weight: bold; font-size: medium" class="mt-5">User Edit</span>
                <a href="{{route('user.index')}}" class="btn btn-outline-secondary btn-sm float-end" >
                    <span class="icon-on"><i class="ri-arrow-left-line align-bottom me-1"></i> Back</span>
                </a>
            </div>
            {!! Form::model($user, ['route' => ['user.update', encode($user->id)], 'method' => 'patch']) !!}
            <div class="card-body">
                <div class="row">
                    <div class="row justify-content-center" style="width: 100%; padding: 0; margin: 0">
                        <div class="form-group mb-2 col-md-3" style="width: 33%; margin-left: 0;">
                            <label for="first_name" class="form-label">First Name <span
                                    class="text-danger">*</span></label>
                            <input id="first_name" type="text" class="form-control {{validateInput($errors, 'first_name')}}" name="first_name" value="{{$user->first_name}}" autocomplete="off" required />
                            @error('first_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-2 col-md-3" style="width: 33%">
                            <label for="middle_name" class="form-label">Middle Name </label>
                            <input id="middle_name" type="text" class="form-control {{validateInput($errors, 'middle_name')}}" name="middle_name" value="{{$user->middle_name}}" autocomplete="off" />
                            @error('middle_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-2 col-md-3" style="width: 33%;">
                            <label for="last_name" class="form-label">Last Name <span
                                    class="text-danger">*</span></label>
                            <input id="last_name" type="text" class="form-control {{validateInput($errors, 'last_name')}}" name="last_name" value="{{$user->last_name}}" autocomplete="off" required />
                            @error('last_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row" style="width: 99%; padding: 0; margin-left: auto; margin-right: auto">
                        <div class="form-group mb-2">
                            <label for="email" class="form-label">Email <span
                                    class="text-danger">*</span></label>
                            <input id="email" type="email" class="form-control" name="email" value="{{$user->email}}" autocomplete="off" />
                        </div>
                        <div class="row justify-content-center" style="width: 100%">
                            <div class="form-group mb-2 col-md-6 ms-0">
                                <label for="institution" class="form-label">Institution <span
                                        class="text-danger">*</span></label><br>
                                @if(auth()->user()->can('oversee all'))
                                    <select id="institution" name="institution_id" class="js-example-basic-single form-control" style="width: 100%;">
                                        <option disabled selected hidden> -- Please Select Institution -- </option>
                                        @foreach(getPluckedInstitutions() as $key => $institution)
                                            <option value="{{encode($key)}}" {{$key == $user->institution->id ? "selected" : ""}}>{{$institution}}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <input id="institution" type="text" class="form-control" value="{{auth()->user()->institution->name}}" disabled />
                                    <input type="hidden" value="{{encode(auth()->user()->institution->id)}}" name="institution_id" />
                                @endif
                            </div>
                            <div class="form-group col-md-6 float-end">
                                <label for="role" class="form-label">Roles <span
                                        class="text-danger">*</span></label><br>
                                <select id="role" name="role" class="js-example-basic-single form-control" style="width: 100%;">
                                    <option disabled selected hidden> -- Please Select Role -- </option>
                                    @foreach($roles as $role)
                                        @if($role->name == 'super-admin' && !auth()->user()->can('oversee all'))
                                            @continue
                                        @endif
                                        <option value="{{encode($role->id)}}" {{$role->id == $user->roles()->first()->id ? "selected" : ""}}>{{$role->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="form-group col-md-6">
                            <label for="department" class="form-label">Department </label><br>
                            <select id="department" name="department" class="js-example-basic-single form-control {{validateInput($errors, 'department_id')}}" style="width: 100%;">
                                <option disabled selected hidden> -- Please Select Department -- </option>
                                @foreach(getPluckedDepartments(auth()->user()->institution->id) as $key => $value)
                                    <option value="{{$key}}">{{ucwords($value)}}</option>
                                @endforeach
                            </select>
                            @error('department_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="designation" class="form-label">Designation </label><br>
                            <select id="designation" name="designation_id" class="js-example-basic-single form-control {{validateInput($errors, 'designation_id')}}" style="width: 100%;">
                                <option disabled selected hidden> -- Please Select Designation -- </option>
                                @foreach(getPluckedDesignations(auth()->user()->institution->id) as $key => $value)
                                    <option value="{{$key}}">{{ucwords($value)}}</option>
                                @endforeach
                            </select>
                            @error('designation_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <div class="card-footer">
                <div class="float-end mb-3 me-1">
                    <a href="{{ route('user.index') }}" class="btn btn-light">Cancel</a>
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>

            {!! Form::close() !!}

        </div>
    </div>

@endsection
