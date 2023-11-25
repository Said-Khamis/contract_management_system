<!-- Details Field -->
<div class="form-group col-sm-6">
    {!! Form::label('details', 'Details:') !!}
    {!! Form::text('details[]', null, ['class' => 'form-control']) !!}
    {!! Form::hidden('contract_id', $contract->id, ['class' => 'form-control custom-select']) !!}
</div>

<!-- Contract Objective Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contract_objective_id', 'Parent:') !!}
    {!! Form::select('contract_objective_id[]',
                    ['' => 'Select Parent'] + getContractObjectives($contract->id)->forget(0)->all(),
                    null,
                    ['class' => 'form-control', 'selected' => true]) !!}
</div>

