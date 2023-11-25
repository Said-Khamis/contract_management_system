<!-- Area Field -->
<div class="form-group col-sm-6">
    {!! Form::label('area', 'Area:') !!}
    {!! Form::text('area[]', null, ['class' => 'form-control']) !!}
    {!! Form::hidden('contract_id', isset($contract) ? $contract->id : $contractOperationArea->contract_id, ['class' => validateInput($errors, 'details').'form-control custom-select']) !!}
</div>


<!-- Contract Areas of Cooperation Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contract_operation_area_id', 'Parent:') !!}
    {!! Form::select('contract_operation_area_id[]',
                    ['' => 'Choose parent area of cooperation'] + getContractOperationAreas(isset($contract) ? $contract->id : $contractOperationArea->contract_id)->forget(0)->all(),
                    null,
                    ['class' => 'form-control', 'selected' => true]) !!}
</div>

<!-- Details Field -->
<div class="form-group col-sm-12">
    {!! Form::label('details', 'Details:') !!}
    {!! Form::textarea('details[]', null, ['class' => validateInput($errors, 'details'). ' form-control','rows' => 3, 'cols' => 10, 'rowspan' => 2, 'colspan' => 3]) !!}
</div>
