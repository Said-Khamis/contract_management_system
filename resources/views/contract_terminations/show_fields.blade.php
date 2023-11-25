<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $contractTermination->id }}</p>
</div>

<!-- Date Of Termination Field -->
<div class="col-sm-12">
    {!! Form::label('date_of_termination', 'Date Of Termination:') !!}
    <p>{{ $contractTermination->date_of_termination }}</p>
</div>

<!-- Reasons Field -->
<div class="col-sm-12">
    {!! Form::label('reasons', 'Reasons:') !!}
    <p>{{ $contractTermination->reasons }}</p>
</div>

<!-- Attachement Id Field -->
<div class="col-sm-12">
    {!! Form::label('attachement_id', 'Attachement Id:') !!}
    <p>{{ $contractTermination->attachement_id }}</p>
</div>

<!-- Created By Field -->
<div class="col-sm-12">
    {!! Form::label('created_by', 'Created By:') !!}
    <p>{{ $contractTermination->created_by }}</p>
</div>

<!-- Updated By Field -->
<div class="col-sm-12">
    {!! Form::label('updated_by', 'Updated By:') !!}
    <p>{{ $contractTermination->updated_by }}</p>
</div>

<!-- Contract Id Field -->
<div class="col-sm-12">
    {!! Form::label('contract_id', 'Contract Id:') !!}
    <p>{{ $contractTermination->contract_id }}</p>
</div>

