<!-- Date Of Termination Field -->
<div class="form-group col-sm-6">
    {!! Form::label('date_of_termination', 'Date Of Termination:') !!}
    {!! Form::text('date_of_termination', null, ['class' => 'form-control','id'=>'date_of_termination']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#date_of_termination').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Reasons Field -->
<div class="form-group col-sm-6">
    {!! Form::label('reasons', 'Reasons:') !!}
    {!! Form::text('reasons', null, ['class' => 'form-control']) !!}
</div>

<!-- Attachement Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('attachement_id', 'Attachement Id:') !!}
    <div class="input-group">
        <div class="custom-file">
            {!! Form::file('attachement_id', ['class' => 'custom-file-input']) !!}
            {!! Form::label('attachement_id', 'Choose file', ['class' => 'custom-file-label']) !!}
        </div>
    </div>
</div>
<div class="clearfix"></div>


<!-- Created By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created_by', 'Created By:') !!}
    {!! Form::text('created_by', null, ['class' => 'form-control']) !!}
</div>

<!-- Updated By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('updated_by', 'Updated By:') !!}
    {!! Form::text('updated_by', null, ['class' => 'form-control']) !!}
</div>

<!-- Contract Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('contract_id', 'Contract Id:') !!}
    {!! Form::number('contract_id', null, ['class' => 'form-control']) !!}
</div>