<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Is Main Field -->
<div class="form-group col-sm-12">
    {!! Form::label('is_main', 'Is Main', ['class' => 'form-check-label']) !!}
    <label class="form-check">
    {!! Form::radio('is_main', "", null, ['class' => 'form-check-input']) !!} 
</label>

</div>


<!-- Is Home Field -->
<div class="form-group col-sm-12">
    {!! Form::label('is_home', 'Is Home', ['class' => 'form-check-label']) !!}
    <label class="form-check">
    {!! Form::radio('is_home', "", null, ['class' => 'form-check-input']) !!} 
</label>

</div>


<!-- Location Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('location_id', 'Location Id:') !!}
    {!! Form::select('location_id', ['' => ''], null, ['class' => 'form-control custom-select']) !!}
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