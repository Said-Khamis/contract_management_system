<!-- Name Field -->
<div class="form-group col-sm-6">
    {{--{!! Form::label('name', 'Name:') !!}--}}
    {{--{!! Form::text('name', null, ['class' => 'form-control']) !!}--}}
    <label for="name">Name</label>
    <input type="text" name="name" id="name" class="form-control" required/>
</div>

<!-- Code Field -->
<div class="form-group col-sm-6">
    <label for="code">Code</label>
    <input type="text" name="code" id="code" class="form-control"/>
    {{--{!! Form::label('code', 'Code:') !!}--}}
{{--    {!! Form::text('code', null, ['class' => 'form-control']) !!}--}}
</div>

<div class="form-group col-sm-12 col-lg-12 mb-3 mt-3">
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
       {{-- <select id="institution_id" name="institution_id" class="institution-select2 form-select" required>
            <option value="{{ auth()->user()->institution->id }}" selected disabled>{{ auth()->user()->institution->name }}</option>
        </select>--}}
    @endif
    {{--{!! Form::label('institution_id', 'Institution', ['class' => 'mb-0']) !!}--}}
    {{--{!! Form::select('institution_id', getHomePartiesPluckednstitutions()->forget(0)->all(), null, ['class' => 'js-example-basic-single form-control']) !!}--}}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    <label for="description">Description</label>
    <textarea id="description" name="description"  class="form-control">
    </textarea>

    {{--{!! Form::label('description', 'Description:') !!}--}}
    {{--{!! Form::textarea('description', null, ['class' => 'form-control']) !!}--}}
</div>