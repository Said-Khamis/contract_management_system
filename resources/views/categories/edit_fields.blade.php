@include('categories.styles')
<!-- Parent Category Field -->
<div class="form-group col-sm-12 mb-2">
    {!! Form::label('category_id', 'Parent Category:') !!}
    <select name="category_id" class="form-control">
        @foreach (getPluckedCategory() as $key => $value)
            <option value="{{ $key }}" {{$category->category_id == $key ? 'selected' : ''}}>
                {{ $value }}
            </option>
        @endforeach
    </select>
</div>
<!-- Name Field -->
<div class="form-group col-sm-6 mb-2 left-col">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', $category->name, ['class' => validateInput($errors, 'name').' form-control','required']) !!}
</div>

<!-- Code Field -->
<div class="form-group col-sm-6 mb-2 right-col">
    {!! Form::label('code', 'Code:') !!}
    {!! Form::text('code', $category->code, ['class' => validateInput($errors, 'code').' form-control', 'required','value' => old($category->code)]) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12 mb-2">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', $category->description, ['class' => validateInput($errors, 'description'). ' form-control','rows' => 3, 'cols' => 10, 'rowspan' => 2, 'colspan' => 3]) !!}
</div>
<div class="modal-footer">
    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
    <input type="submit" class="btn btn-primary" value="Save" />
</div>
<input type="text" id="companyname-field" hidden name="created_by" value="{{ \Illuminate\Support\Facades\Auth::user()->id }}" class="form-control" placeholder="Enter Name" required />
<input type="text" id="companyname-field" hidden name="updated_by" value="{{ \Illuminate\Support\Facades\Auth::user()->id }}" class="form-control" placeholder="Enter Name" required />


