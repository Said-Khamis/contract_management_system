<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

<!-- Current Approval Flow Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('current_approval_flow_id', 'Current Approval Flow Id:') !!}
    {!! Form::select('current_approval_flow_id', [], null, ['class' => 'form-control']) !!}
</div>

<!-- Current Approval Group Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('current_approval_group_id', 'Current Approval Group Id:') !!}
    {!! Form::select('current_approval_group_id', [], null, ['class' => 'form-control']) !!}
</div>

<!-- Current Approval Role Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('current_approval_role_id', 'Current Approval Role Id:') !!}
    {!! Form::select('current_approval_role_id', [], null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-end">
    <a href="{!! route('approvals.index') !!}" class="btn btn-default">Cancel</a>
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
</div>
