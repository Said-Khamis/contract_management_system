<!-- Contract Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contract_id', 'Contract Id:') !!}
    {!! Form::number('contract_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Created By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created_by', 'Created By:') !!}
    {!! Form::number('created_by', null, ['class' => 'form-control']) !!}
</div>

<!-- Updated By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('updated_by', 'Updated By:') !!}
    {!! Form::number('updated_by', null, ['class' => 'form-control']) !!}
</div>

<!-- Comment Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('comment', 'Comment:') !!}
    {!! Form::textarea('comment', null, ['class' => 'form-control']) !!}
</div>

<!-- Percent Field -->
<div class="form-group col-sm-6">
    {!! Form::label('percent', 'Percent:') !!}
    {!! Form::number('percent', null, ['class' => 'form-control']) !!}
</div>