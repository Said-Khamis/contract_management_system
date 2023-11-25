<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:',['style'=>'float:left']) !!}
    {!! Form::text('name', null, ['class' =>  validateInput($errors, 'name').'form-control text-uppercase']) !!}
    <span id="errorName"></span>
</div>

<!-- Region Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('region_id', 'Region:',['style'=>'float:left']) !!}
    {!! Form::select('region_id',getPluckedRegion(), null, ['class' =>  validateInput($errors, 'region_id').'form-control text-uppercase select2']) !!}
    <span id="errorRegion"></span>
</div>


<select class="js-example-basic-multiple select2-hidden-accessible" name="states[]" multiple="" data-select2-id="select2-data-19-rz0e" tabindex="-1" aria-hidden="true">
    <optgroup label="UK" data-select2-id="select2-data-37-tcr1">
        <option value="London" data-select2-id="select2-data-38-b9z4">London</option>
        <option value="Manchester" selected="" data-select2-id="select2-data-21-0kzm">Manchester</option>
        <option value="Liverpool" data-select2-id="select2-data-39-k0mr">Liverpool</option>
    </optgroup>
    <optgroup label="FR" data-select2-id="select2-data-40-lklk">
        <option value="Paris" data-select2-id="select2-data-41-a1dq">Paris</option>
        <option value="Lyon" data-select2-id="select2-data-42-z4yx">Lyon</option>
        <option value="Marseille" data-select2-id="select2-data-43-zgdb">Marseille</option>
    </optgroup>
    <optgroup label="SP" data-select2-id="select2-data-44-rw5z">
        <option value="Madrid" selected="" data-select2-id="select2-data-22-3d6z">Madrid</option>
        <option value="Barcelona" data-select2-id="select2-data-45-k2b3">Barcelona</option>
        <option value="Malaga" data-select2-id="select2-data-46-zb2w">Malaga</option>
    </optgroup>
    <optgroup label="CA" data-select2-id="select2-data-47-3aq3">
        <option value="Montreal" data-select2-id="select2-data-48-a79h">Montreal</option>
        <option value="Toronto" data-select2-id="select2-data-49-lbwm">Toronto</option>
        <option value="Vancouver" data-select2-id="select2-data-50-g2s5">Vancouver</option>
    </optgroup>
</select>
