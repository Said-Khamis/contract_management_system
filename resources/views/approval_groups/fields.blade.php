<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Rank Field -->
<div class="form-group col-sm-6">
    {!! Form::label('rank', 'Rank:') !!}
    {!! Form::select('rank', ['1' => 'One', '2' => 'two', '3' => 'three', '4' => 'four','5' => 'five','6' => 'six','7' => 'seven','8' => 'eight','9' => 'nine'], null,
    ['class' => 'form-control general-select2']) !!}
</div>

<!-- Role Id Field -->
<div class="form-group col-sm-12">
    {!! Form::label('role_id', 'Roles :') !!}
    {!! Form::select('role_id[]', [getRoles()], null, ['class' => 'form-control general-selector' ,'multiple'=>'multiple']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12 text-end">
    <a href="{!! route('approvalGroups.index') !!}" class="btn btn-default">Cancel</a>
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
</div>
