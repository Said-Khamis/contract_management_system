
<div class="form-group col-sm-12">
    {!! Form::label('country_id', 'Select Country') !!}
    {!! Form::select('country_id', getPluckedCountryWithState(), null, ['class' => 'form-control select2 py-2']) !!}
    <span id="errorCountry"></span>
</div>


<!-- Name Field -->
<div class="form-group col-sm-12">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control','required']) !!}
    <span id="errorName"></span>
</div>
