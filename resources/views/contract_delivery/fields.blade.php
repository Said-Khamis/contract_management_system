<!-- Contract Areas of Cooperation Id Field -->
<div class="form-group col-sm-6">
    <label for="type">Type:</label>
    <select name="type" id="type" required class="form-control">
        <option value="">Choose Type</option>
        <option value="Meeting" {{ isset($contractDelivery) && $contractDelivery->type == 'Meeting' ? 'selected' : '' }}>Meeting</option>
    </select>
</div>
<div class="form-group col-sm-6">
    <label for="unit">Unit:</label>
    <select id="unit" name="unit" required class="form-control">
        <option value="">Choose</option>
        <option value="each">Each</option>
        <option value="at">At</option>
    </select>
</div>

<div class="each-content" style="display: none;">
    <div class="row">
        <div class="form-group col-sm-6">
            <label for="duration">Duration (In months):</label>
            <input type="text" name="duration" id="duration" class="form-control">
        </div>
        <div class="form-group col-sm-6">
            <label for="starting_time">Starting Time:</label>
            <div class="input-group">
                 <input type="date" name="start_time" id="startDateInput" class="form-control">
            </div>
        </div>
    </div>
</div>

<div class="at-content" style="display: none;">
    {{--<!-- Time Field -->--}}
    <div class="form-group col-sm-12">
        <label for="date">Date:</label>
        <input type="date" name="time" id="time" class="form-control">
    </div>
    <div class="form-group col-sm-6">
        <label for="each_year">Each Year:</label>
        <input type="checkbox" name="annual_event" id="annual_event" value="1">
    </div>
</div>

<!-- Time Field -->
<div class="form-group col-sm-12">
    <label for="title">Title:</label>
    <input type="text" name="title" required id="title" class="form-control">
</div>

<!-- Details Field -->
<div class="form-group col-sm-12">
    <label for="details">Details:</label>
    <textarea name="details" id="details" class="form-control" rows="3" cols="10"></textarea>
</div>
