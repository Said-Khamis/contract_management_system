<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:', ['style' => 'float: left;']) !!}
    {!! Form::text('name', null, ['class' =>  validateInput($errors, 'name').'form-control text-uppercase']) !!}
    <span id="errorName"></span>
</div>

<!-- Code Field -->
<div class="form-group col-sm-6">
    {!! Form::label('code', 'Code:', ['style' => 'float: left;']) !!}
    {!! Form::text('code', null, ['class' =>  validateInput($errors, 'code').'form-control text-uppercase']) !!}
    <span id="errorCode"></span>
</div>

<!-- Duration Field -->
<div class="form-group mt-3">
    <span id="errorFlexRadioDefault"></span>

        <!-- Base Radios -->
    <div class="form-check form-switch form-switch-custom form-switch-info mb-2">
        <input class="form-check-input" type="radio" value="1" name="flexRadioDefault" id="flexRadioDefault1" {{($country?->hasRegion)?'checked':''}}>
        <label class="form-check-label" for="flexRadioDefault1">
            Has Region
        </label>
    </div>

    <div class="form-check form-switch form-switch-custom form-switch-warning mb-2">
        <input class="form-check-input" value="2" type="radio" name="flexRadioDefault" id="flexRadioDefault3" {{($country?->hasState)?'checked':''}}>
        <label class="form-check-label" for="flexRadioDefault3">
            Has State
        </label>
    </div>

    <div class="form-check form-switch form-switch-custom form-switch-secondary">
        <input class="form-check-input" value="3" type="radio" name="flexRadioDefault" id="flexRadioDefault2" {{($country?->hasCity)?'checked':''}}>
        <label class="form-check-label" for="flexRadioDefault2">
            Has City
        </label>
    </div>
</div>
