<!-- Comment Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('comment', 'Comment:') !!}
    {!! Form::textarea('comment', null, ['class' => 'form-control']) !!}
</div>

<!-- Approval Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('approval_id', 'Approval Id:') !!}
    {!! Form::select('approval_id', ['tech' => 'Technology', 'ls' => 'LifeStyle', 'edu' => 'Education', 'game' => 'Games'], null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('approvalHistories.index') !!}" class="btn btn-default">Cancel</a>
</div>
