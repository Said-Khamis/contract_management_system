<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:', ['style' => 'float: left;']) !!}
    {!! Form::text('name', null, ['class' => validateInput($errors, 'name').'form-control text-uppercase']) !!}
    <span id="errorName"></span>
</div>

<!-- Country Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('country_id', 'Country:', ['style' => 'float: left;']) !!}
    {!! Form::select('country_id', getPluckedCountryWithRegion(),null, ['class' => validateInput($errors, 'country_id').'form-control text-uppercase']) !!}
    <span id="errorCountry"></span>
</div>
