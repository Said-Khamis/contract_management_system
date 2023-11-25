<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name',null , ['class' => 'form-control']) !!}
    <span id="errorName"></span>
</div>

<!-- Country Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('country_id', 'Country:') !!}
    {!! Form::select('country_id', getPluckedCountryWithCity(), null, ['class' => 'form-control select2 py-2']) !!}
    <span id="errorCountry"></span>
</div>

