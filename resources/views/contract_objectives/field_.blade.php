<!-- Details Field -->
<div class="form-group col-sm-12">
    {!! Form::label('details', 'Details:') !!}
    {!! Form::text('details[]', null, ['class' => 'form-control']) !!}
    {!! Form::hidden('contract_id', $contractObjective->contract_id, ['class' => 'form-control custom-select']) !!}

</div>
