@extends('layouts.master')
@section( 'title','Edit Role')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6 mb-2">
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        <div class="card shadow-sm">
            <div class="card-header py-3">
                <span style="font-weight: bold; font-size: medium" class="mt-5">Edit Role</span>
                <a href="{{route('user.role','roles')}}" class="btn btn-outline-secondary btn-sm float-end" >
                    <span class="icon-on"><i class="ri-arrow-left-line align-bottom me-1"></i> Back</span>
                </a>
            </div>
            {!! Form::model($role, ['route' => ['role.update', encode($role->id)], 'method' => 'PATCH']) !!}

            <fieldset style="display: contents" {{$role->name == 'super-admin' || $role->name == 'admin' ? 'disabled' : ''}}>
                <div class="card-body">

                    <div class="row">
                        <div class="form-group mb-2">
                            <label for="role_name">Role Name <span
                                    class="text-danger">*</span></label>
                            <input id="role_name" type="text" name="name" value="{{$role->name}}" class="form-control" required {{$role->name == 'super-admin' ? 'disabled' : ''}}>
                        </div>
                        <div class="form-group mb-2">
                            <label for="institution" class="form-label">Institution <span
                                    class="text-danger">*</span></label><br>
                            @if(auth()->user()->can('oversee all'))
                                <select id="institution" name="institution_id" class="js-example-basic-single form-control" style="width: 100%;">
                                    <option value="" disabled selected hidden> -- Please Select Institution -- </option>
                                    @foreach(getPluckedInstitutions() as $key => $institution)
                                        <option value="{{$key}}" @if(!is_null($role->institution)){{$key == $role->institution->id ? "selected" : ""}}@endif>{{$institution}}</option>
                                    @endforeach
                                </select>
                            @else
                                <input id="institution" type="text" class="form-control" value="{{auth()->user()->institution->name}}" disabled />
                                <input type="hidden" value="{{encode(auth()->user()->institution->id)}}" name="institution_id" />
                            @endif
                        </div>
                        <div class="clearfix"></div>
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group mt-2">
                                    <label class="mb-0">Role Permissions</label>
                                </div>
                                <hr>
                            </div>
                            @foreach($permissions as $group => $group_permissions)
                                <div class="col-md-2 mb-2">
                                    <input id="{{$group}}-header" class="form-check-input group-header" type="checkbox" data-permission-group="{{$group}}-checkbox-group" />
                                    <label for="{{$group}}-header"><span class="fw-bold"> {{strtoupper($group)}}</span></label><br>
                                    <hr>
                                    @foreach($group_permissions as $permission)
                                        <input type="checkbox" class="form-check-input checkbox-group {{$group}}-checkbox-group" name="permissions[]" value="{{$permission->name}}"
                                               data-group-header="{{$group}}-header" data-group-permission="{{$group}}-checkbox-group" {{$role->hasPermissionTo($permission->name) != 1 ? '' : 'checked'}}> {{$permission->name}}<br>
                                    @endforeach
                                    <hr class="my-3">
                                </div>
                            @endforeach
                        </div>
                    </div>

                </div>

                <div class="card-footer">
                    <div class="float-end mb-3">
                        <a href="{{route('user.role','roles')}}" class="btn btn-light">Cancel</a>
                        {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
            </fieldset>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
