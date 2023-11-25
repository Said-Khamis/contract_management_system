<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h5>Edit Timeline Delivery </h5>
            </div>
        </div>
    </div>
</section>
<div class="content px-3">
    <div class="card">
        {!! Form::model($contractDelivery, ['route' => ['contractDeliveries.update', $contractDelivery->id], 'method' => 'patch']) !!}
        <div class="card-body">
            <div class="row">
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
                        <option value="each" {{ isset($contractDelivery) && $contractDelivery->unit == 'each' ? 'selected' : '' }}>Each</option>
                        <option value="at" {{ isset($contractDelivery) && $contractDelivery->unit == 'at' ? 'selected' : '' }}>At</option>
                    </select>
                </div>

                <div id="eachFields" class="row" style="display: none;">
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

                <div id="atFields" class="form-group col-sm-12" style="display: none;">
                    <label for="date">Date:</label>
                    <input type="date" name="time" id="time" class="form-control">
                </div>

                <div class="form-group col-sm-6">
                    <label for="each_year">Each Year:</label>
                    <input type="checkbox" name="annual_event" id="annual_event" value="1">
                </div>

                <!-- Title Field -->
                    <div class="form-group col-sm-12">
                        <label for="title">Title:</label>
                        <input type="text" name="title" required id="title" class="form-control" value="{{ isset($contractDelivery) ? $contractDelivery->title : '' }}">
                    </div>

                    <!-- Details Field -->
                    <div class="form-group col-sm-12">
                        <label for="details">Details:</label>
                        <textarea name="details" id="details" class="form-control" rows="3" cols="10">{{ isset($contractDelivery) ? $contractDelivery->details : '' }}</textarea>
                    </div>

            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}
    </div>
</div>
@section('script')

<script>
    // Get the select element
    var unitSelect = document.getElementById('unit');

    // Get the elements to be displayed conditionally
    var eachFields = document.getElementById('eachFields');
    var atFields = document.getElementById('atFields');

    // Add an event listener to the select element
    unitSelect.addEventListener('change', function () {
        // Check the selected value
        if (unitSelect.value === 'each') {
            eachFields.style.display = 'block';
            atFields.style.display = 'none';
        } else if (unitSelect.value === 'at') {
            eachFields.style.display = 'none';
            atFields.style.display = 'block';
        } else {
            eachFields.style.display = 'none';
            atFields.style.display = 'none';
        }
    });
</script>

@endsection
