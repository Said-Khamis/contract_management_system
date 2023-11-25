<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $approval->id !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $approval->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $approval->updated_at !!}</p>
</div>

<!-- Is Approved Field -->
<div class="form-group">
    {!! Form::label('is_approved', 'Is Approved:') !!}
    <p>{!! $approval->is_approved !!}</p>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', 'Status:') !!}
    <p>{!! $approval->status !!}</p>
</div>

<!-- Created By Field -->
<div class="form-group">
    {!! Form::label('created_by', 'Created By:') !!}
    <p>{!! $approval->created_by !!}</p>
</div>

<!-- Updated By Field -->
<div class="form-group">
    {!! Form::label('updated_by', 'Updated By:') !!}
    <p>{!! $approval->updated_by !!}</p>
</div>

<!-- Current Approval Flow Id Field -->
<div class="form-group">
    {!! Form::label('current_approval_flow_id', 'Current Approval Flow Id:') !!}
    <p>{!! $approval->current_approval_work_flow_id !!}</p>
</div>

<!-- Current Approval Group Id Field -->
<div class="form-group">
    {!! Form::label('current_approval_group_id', 'Current Approval Group Id:') !!}
    <p>{!! $approval->current_approval_group_id !!}</p>
</div>

<!-- Current Approval Role Id Field -->
<div class="form-group">
    {!! Form::label('current_approval_role_id', 'Current Approval Role Id:') !!}
    <p>{!! $approval->current_approval_role_id !!}</p>
</div>

