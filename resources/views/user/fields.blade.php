<div>
    <div class="row">
        <div class="form-group mb-2 col-md-4">
            <label for="first_name" class="form-label">First Name <span
                    class="text-danger">*</span></label>
            <input id="first_name" type="text" wire:model="first_name" class="form-control {{validateInput($errors, 'first_name', $first_name)}}" name="first_name" autocomplete="off" />
            @error('first_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-2 col-md-4">
            <label for="middle_name" class="form-label">Middle Name </label>
            <input id="middle_name" type="text" class="form-control {{validateInput($errors, 'middle_name')}}" name="middle_name" autocomplete="off" />
            @error('middle_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-2 col-md-4">
            <label for="last_name" class="form-label">Last Name <span
                    class="text-danger">*</span></label>
            <input id="last_name" type="text" wire:model="last_name" class="form-control {{validateInput($errors, 'last_name', $last_name)}}" name="last_name" autocomplete="off" />
            @error('last_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row">
        <div class="form-group mb-3">
            <label for="email" class="form-label">Email <span
                    class="text-danger">*</span></label>
            <input id="email" type="email" wire:model="email" class="form-control {{validateInput($errors, 'email', $email)}}" name="email" autocomplete="off" />
            @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

    </div>
    <div class="row" wire:ignore>
        <div class="form-group col-md-6">
            @if(auth()->user()->can('oversee all'))
                <label for="institution_select" class="form-label">Institution <span
                        class="text-danger">*</span></label><br>
                <select id="institution_select" name="institution_id" class="js-example-basic-single form-control {{validateInput($errors, 'institution_id', $institution_id)}}" style="width: 100%;">
                    <option disabled selected hidden> -- Please Select Institution -- </option>
                    @foreach(getPluckedInstitutions() as $key => $institution)
                        <option value="{{encode($key)}}">{{$institution}}</option>
                    @endforeach
                </select>
            @else
                <label for="institution_input" class="form-label">Institution <span
                        class="text-danger">*</span></label><br>
                <input id="institution_input" type="text" class="form-control" value="{{auth()->user()->institution->name}}" disabled />
                <input type="hidden" value="{{encode(auth()->user()->institution->id)}}" name="institution_id" />
            @endif
            @error('institution_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="role" class="form-label">Role <span class="text-danger">*</span></label><br>
            <select id="role" name="role" class="js-example-basic-single form-control {{validateInput($errors, 'institution_id', $institution_id)}}" style="width: 100%;">
                <option disabled selected hidden> -- Please Select Role -- </option>
                @foreach($roles as $role)
                    @if($role->name == 'super-admin' && !auth()->user()->can('oversee all'))
                        @continue
                    @endif
                    <option value="{{encode($role->id)}}">{{$role->name}}</option>
                @endforeach
            </select>
            @error('role')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
    <div class="row mt-3" wire:ignore>
        <div class="form-group col-md-6">
            <label for="department" class="form-label">Department </label><br>
            <select id="department" name="department" class="js-example-basic-single form-control {{validateInput($errors, 'department_id', $department_id)}}" style="width: 100%;">
                <option disabled selected hidden> -- Please Select Department -- </option>
                @if(auth()->user()->can('oversee all'))
                    @foreach(getPluckedDepartments() as $key => $value)
                        <option value="{{$key}}">{{ucwords($value)}}</option>
                    @endforeach
                @else
                    @foreach(getPluckedDepartments(auth()->user()->institution->id) as $key => $value)
                        <option value="{{$key}}">{{ucwords($value)}}</option>
                    @endforeach
                @endif
            </select>
            @error('department_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group col-md-6">
            <label for="designation" class="form-label">Designation </label><br>
            <select id="designation" name="designation_id" class="js-example-basic-single form-control {{validateInput($errors, 'designation_id', $designation_id)}}" style="width: 100%;">
                <option disabled selected hidden> -- Please Select Designation -- </option>
                @if(auth()->user()->can('oversee all'))
                    @foreach(getPluckedDesignations() as $key => $value)
                        <option value="{{$key}}">{{ucwords($value)}}</option>
                    @endforeach
                @else
                    @foreach(getPluckedDesignations(auth()->user()->institution->id) as $key => $value)
                        <option value="{{$key}}">{{ucwords($value)}}</option>
                    @endforeach
                @endif
            </select>
            @error('designation_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>

{{--@push('custom-scripts')--}}
{{--    <script>--}}
{{--        $(document).ready(function () {--}}
{{--            $('#institution_select').on('change', function (e) {--}}
{{--                const value = $('#institution_select').select2("val");--}}
{{--                @this.set('institution_id', value);--}}
{{--            });--}}
{{--        })--}}
{{--    </script>--}}
{{--@endpush--}}
