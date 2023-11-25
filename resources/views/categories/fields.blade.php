@include('categories.styles')
<!-- Parent Category Field -->
<div class="form-group col-sm-12 mb-2">
    {!! Form::label('category_id', 'Parent Category:') !!}
    {!! Form::select('category_id', [''=>'Choose category',getPluckedCategory()], null, ['class' => validateInput($errors, 'description'). ' form-control']) !!}
</div>
<!-- Name Field -->
<div class="form-group col-sm-6 mb-2 left-col">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => validateInput($errors, 'name').' form-control','required']) !!}
</div>

<!-- Code Field -->
<div class="form-group col-sm-6 mb-2 right-col">
    {!! Form::label('code', 'Code:') !!}
    {!! Form::text('code', null, ['class' => validateInput($errors, 'code').' form-control','required']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12 mb-2">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => validateInput($errors, 'description'). ' form-control','rows' => 3, 'cols' => 10, 'rowspan' => 2, 'colspan' => 3]) !!}
</div>

{{--<input type="text" id="companyname-field" hidden name="created_by" value="{{ \Illuminate\Support\Facades\Auth::user()->id }}" class="form-control" placeholder="Enter Name" required />
<input type="text" id="companyname-field" hidden name="updated_by" value="{{ \Illuminate\Support\Facades\Auth::user()->id }}" class="form-control" placeholder="Enter Name" required />--}}


