<!-- Responsibility Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('responsibility_id', 'Responsibility Id:') !!}
    {!! Form::select('responsibility_id', ['' => ''], null, ['class' => 'form-control custom-select']) !!}
</div>


<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::number('status', null, ['class' => 'form-control']) !!}
</div>

<!-- Comment Field -->
<div class="form-group col-sm-6">
    {!! Form::label('comment', 'Comment:') !!}
    {!! Form::text('comment', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Updated At Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status_updated_at', 'Status Updated At:') !!}
    {!! Form::text('status_updated_at', null, ['class' => 'form-control','id'=>'status_updated_at']) !!}
</div>

@push('page_scripts')
    <script type="text/javascript">
        $('#status_updated_at').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Created By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('created_by', 'Created By:') !!}
    {!! Form::number('created_by', null, ['class' => 'form-control']) !!}
</div>

<!-- Updated By Field -->
<div class="form-group col-sm-6">
    {!! Form::label('updated_by', 'Updated By:') !!}
    {!! Form::text('updated_by', null, ['class' => 'form-control']) !!}
</div>