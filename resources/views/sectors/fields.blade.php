<!-- Name Field -->
<div class="form-group col-sm-6">
    <label for="name">Name</label>
    <input id="name" name="name" class="form-control" required/>
    <span id="error"></span>
</div>

<!-- Description Field -->
<div class="form-group col-sm-6">
    <label for="description">Description</label>
    <input id="description" name="description"  class="form-control"/>

    @error('description')
    <span  class="is-invalid" style="color: red;"> {{ $message }}</span>
    @enderror
</div>
