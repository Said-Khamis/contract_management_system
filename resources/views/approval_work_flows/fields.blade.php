<!-- Name Field -->
<div class="form-group col-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control '.validateInput($errors,'name')]) !!}
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Rank Field -->
<div class="form-group col-6">
    {!! Form::label('rank', 'Rank:') !!}
    {!! Form::select('rank', ['1' => 'One', '2' => 'two', '3' => 'three', '4' => 'four','5' => 'five','6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine'], null,
    ['class' => 'form-control general-select2']) !!}
</div>

<!-- Type Field -->
<div class="form-group col-6">
    {!! Form::label('type', 'Type :') !!}
    {!! Form::select('type', approvalWorkFlows(), null, ['class' => 'form-control general-select2 '.validateInput($errors, 'type') ]) !!}
    @error('type')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
<!-- Approval Group Id Field -->
<div class="form-group col-6">
    {!! Form::label('approval_group_id', 'Approval groups :') !!}
    {!! Form::select('approval_group_id', [getPluckedApprovalGroups()], null, ['class' => 'form-control general-selector','name'=>'approval_group_id[]' ,'multiple'=>'multiple']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-12 text-end">
    <a href="{!! route('approvalWorkFlows.index') !!}" class="btn btn-default">Cancel</a>
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
</div>
