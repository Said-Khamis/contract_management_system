<!-- Name Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::file('file', ['class' => 'form-control', 'accept' => 'application/pdf']) !!}
    {!! Form::hidden('contract_id', isset($contract) ? $contract->id : $contractActionPlan->contract_id, ['class' => 'form-control custom-select']) !!}

</div>
