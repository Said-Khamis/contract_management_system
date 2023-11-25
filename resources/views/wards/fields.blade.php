<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:',['style'=>'float:left']) !!}
    {!! Form::text('name', null, ['class' => validateInput($errors, 'name').'form-control text-uppercase']) !!}
    <span id="errorName"></span>
</div>

<!-- District Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('district_id', 'District Id:',['style'=>'float:left']) !!}
    {!! Form::select('district_id', getPluckedDistrict(), null, ['class' => validateInput($errors, 'district_id').'form-control custom-select text-uppercase']) !!}
    <span id="errorDistrict"></span>
</div>

