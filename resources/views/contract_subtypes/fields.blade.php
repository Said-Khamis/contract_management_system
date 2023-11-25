<!-- Name Field -->
<div class="form-group col-sm-6">
    <label for="name">Name</label>
    <input id="name" name="name" class="form-control" required/>
    <span id="error"></span>
</div>
<div class="form-group col-sm-6 mb-3">
    <label class="mb-0" for="type">Contract Type</label>
    <span style="font-size: 1.2em;font-weight: bolder" class="text-danger">*</span>
    <select id="type" class="form-select  @error('type') is-invalid @enderror" name="type" required aria-label="Default select example">
        <option value="" selected>Please Select Contract Type</option>
        @foreach(config('data.contract_types') as $key => $value)
            <option value="{{$key}}">{{$value}}</option>
        @endforeach
    </select>
{{--    <span id="type_error"></span>--}}
{{--    @error('type')--}}
{{--    <div class="invalid-feedback">{{ $message }}</div>--}}
{{--    @enderror--}}
</div>
<!-- Description Field -->
<div class="form-group col-sm-12">
    <label for="description">Description</label>
    <input id="description" name="description"  class="form-control"/>
    @error('description')
    <span  class="is-invalid" style="color: red;"> {{ $message }}</span>
    @enderror
</div>
