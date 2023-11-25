<!-- Name Field -->
<div class="form-group col-sm-12">
    <label for="title">Title</label>
    <input type="text" class="form-control" name="title" id="title" required>
    {{--{!! Form::label('title', 'Title:') !!}--}}
    {{--{!! Form::text('title', null, ['class' => 'form-control','required']) !!}--}}
    {{--<span id="errorTitle"></span>--}}
</div>

<div class="form-group col-sm-12 mt-3">
    <label for="institution_id">Institution</label>
    @if(auth()->user()->can('oversee all'))
    <select id="institution_id" name="institution_id" class="institution-select2 form-select" required>
        {{--<option disabled selected hidden>--- Select Institution ---</option>--}}
        @if(count(getPluckedInstitutionsRolesBased()) > 0)
            @foreach(getPluckedInstitutionsRolesBased() as $key => $institute)
                <option value="{{ $key }}">{{ $institute }}</option>
            @endforeach
        @endif
    </select>
    @else
        <input type="hidden" name="institution_id" value="{{auth()->user()->institution->id}}">
        <input class="form-control" id="institution_id" type="text"  value="{{auth()->user()->institution->name}}" disabled="disabled">
        {{--<select id="institution_id" name="institution_id" class="institution-select2 form-select" required>
            <option value="{{auth()->user()->institution->id}}" selected disabled>{{auth()->user()->institution->name}}</option>
        </select>--}}
    @endif
</div>

<div class="form-group col-sm-12 mt-3">
    <label for="department">Department</label>
    <select id="department" name="department_id" class="department-select2 form-control {{validateInput($errors, 'department_id')}}" style="width: 100%;">
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

<div class="form-group col-sm-12 mt-3">
    <label for="description">Descriptions</label>
    <textarea id="description" name="description" class="form-control" required></textarea>
    {{--{!! Form::label('descriptions', 'Descriptions:') !!}--}}
    {{--{!! Form::textarea('description', null, ['class' => 'form-control', 'rows' => 2, 'cols' => 10, 'rowspan' => 2, 'colspan' => 3]) !!}--}}
</div>
