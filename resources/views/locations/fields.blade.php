
<!-- District Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('district_id', 'District Id:') !!}
    {!! Form::select('district_id', ['' => ''], null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- City Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('city_id', 'City Id:') !!}
    {!! Form::select('city_id', ['' => ''], null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Region Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('region_id', 'Region Id:') !!}
    {!! Form::select('region_id', ['' => ''], null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- State Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('state_id', 'State Id:') !!}
    {!! Form::select('state_id', ['' => ''], null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Ward Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('ward_id', 'Ward Id:') !!}
    {!! Form::select('ward_id', ['' => ''], null, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Settlement Field -->
<div class="form-group col-sm-6">
    {!! Form::label('settlement', 'Settlement:') !!}
    {!! Form::text('settlement', null, ['class' => 'form-control']) !!}
</div>
