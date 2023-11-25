
{{--{{ $institution }}--}}
<!-- Name Field -->
<div class="form-group col-sm-8">
    <label for="name">Name</label>
    <input id="name" name="name" class="form-control" required/>
    {{--@error('name')--}}
      {{--<span class="is-invalid" style="color: red;"> {{ $message }}</span>--}}
    {{--@enderror--}}

{{--     {!! Form::label('name', 'Name:') !!}--}}
{{--     {!! Form::text('name', null, ['class' => validateInput($errors, 'name').'form-control']) !!}--}}
     <span id="error"></span>
</div>

<!-- Abbreviation Field -->
<div class="form-group col-sm-4">
    <label for="abbreviation">Abbreviation</label>
    <input id="abbreviation" name="abbreviation"  class="form-control"/>

    {{--    {!! Form::label('abbreviation', 'Abbreviation:') !!}--}}
    {{-- {!! Form::text('abbreviation', null, ['class' => validateInput($errors, 'abbreviation').'form-control','required']) !!}--}}
    {{--    <span id="errorAbbreviation"></span>--}}

    @error('abbreviation')
      <span  class="is-invalid" style="color: red;"> {{ $message }}</span>
    @enderror
</div>

<!-- Is Local Field -->
<div class="form-group col-sm-12  mt-3">
    <input type="checkbox" id="is_local" name="is_local" value="1">
    <label for="is_local">This is Local Institution</label>
{{--    {!! Form::checkbox('is_local', '1', isset($institution) ? $institution->is_local : false, ['class' => 'form-check-input']) !!}--}}
{{--    {!! Form::label('is_local', 'This is Local Institution', ['class' => 'form-check-label']) !!}--}}
</div>

<!-- Is Sector Field -->
<div class="form-group col-sm-12  mt-3">
    <input type="checkbox" id="is_sector" name="is_sector" value="1">
    <label for="is_sector">This is a Sector</label>
{{--    {!! Form::checkbox('is_sector', '1', isset($institution) ? $institution->is_sector : false, ['class' => 'form-check-input']) !!}--}}
{{--    {!! Form::label('is_sector', 'This is a Sector', ['class' => 'form-check-label']) !!}--}}
</div>

<div class=" col-sm-12 mt-3 form-group">
    <label for="institution_id">Select Parent Institution(if any)</label>
    <select id="institution_id" name="institution_id" class="institution-select2-2 form-select">
{{--        <option disabled selected hidden>--- Select Institution ---</option>--}}
        @if(count(getPluckedInstitutionsRolesBased()) > 0)
            @foreach(getPluckedInstitutionsRolesBased() as $key => $institute)
                <option value="{{ $key }}">{{ $institute }}</option>
            @endforeach
        @endif
    </select>
</div>

{{--<div class="form-group col-sm-12  mt-3">--}}
{{--    {!! Form::label('institution_id', 'Select Parent Institution(if any)') !!}--}}
{{--    {!! Form::select('institution_id', getPluckedInstitutionsRolesBased(), null, ['class' => 'form-control institution-select2 py-2', 'placeholder'=>'Select its Parent Institution']) !!}--}}
{{--</div>--}}
