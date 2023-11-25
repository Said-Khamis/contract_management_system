<div class="card-header">
     <span>TITLE:  {{ $contracts->title }} </span>
</div>
<div class="form-group">
        <label for="user">Select Role:</label>
        <select name="user" id="user" class="form-control">
            @foreach($roles as $role)
                <option value="{{ $role->name }}">{{ $role->name }}</option>
            @endforeach
        </select>
</div>
