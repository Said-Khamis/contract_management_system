<div class="form-group">
    <label>Send to:</label>
    <div class="d-block">
        <div class="form-check form-radio-success mb-3 d-inline-block">
            <input class="form-check-input d-inline-block" type="radio" name="send_to" id="formradioRight7" checked="">
            <label class="form-check-label" for="formradioRight7">
                Internal Staff
            </label>
        </div>
        
        <div class="form-check form-radio-success mb-3 d-inline-block">
            <input class="form-check-input d-inline-block" type="radio" name="send_to" id="formradioRight5">
            <label class="form-check-label" for="formradioRight5">
                Another Institution
            </label>
        </div>
    </div>
</div>

<div class="form-group mt-3" id="institution_to">
    {!! Form::label('to_institution_id', 'Institution To:') !!}
    <span style="font-size: 1.2em;font-weight: bolder" class="text-danger">*</span>
    {!! Form::select(
        'to_institution_id',getOtherInstitutions(), null,
        ['class' => 'form-control js-example-basic-single', 'placeholder' => '-- select institution --'],
    ) !!}
</div>

<div class="form-group my-1" id="to_staff">
    {!! Form::label('user_id', 'To staff:') !!}
    <span style="font-size: 1.2em;font-weight: bolder" class="text-danger">*</span>
    {!! Form::select('user_id', getUsersFromMyInstitution(), null, [
        'class' => 'form-control js-example-basic-single',
        'placeholder' => '-- select staff --',
    ]) !!}
</div>

<div class="form-group mt-3">
    {!! Form::label('comment', 'Description:') !!}
    {!! Form::textarea('comment', null, ['rows'=>'5', 'class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-12 col-md-5 col-lg-5 mt-3">
    <label for="attachment_files" class="form-label mb-0">Attachment Name</label>
    <input type="text" id="attachment_name" class="form-control " name="attachment_name">
</div>

<div class="form-group col-sm-12 col-md-7 col-lg-7 mt-3">
    <label for="attachment_file" class="form-label mb-0">Attachment</label>
    <input type="file" id="attachment_file" class="form-control " name="attachment_file" accept=".pdf">
</div>

<input type="hidden" class="form-control" name="previous_url" value="{{ URL::previous() }}/#internal_procedure">


<script>
    document.addEventListener("DOMContentLoaded", function () {
        const radioInternalStaff = document.getElementById("formradioRight7");
        const radioAnotherInstitution = document.getElementById("formradioRight5");
        const institution_to = document.getElementById("institution_to");
        const to_staff = document.getElementById("to_staff");

        function toggleFields() {
            if (radioInternalStaff.checked) {
                institution_to.style.display = "none";
                to_staff.style.display = "block";
            } else if (radioAnotherInstitution.checked) {
                institution_to.style.display = "block";
                to_staff.style.display = "none";
            }
        }

        toggleFields();

        radioInternalStaff.addEventListener("change", toggleFields);
        radioAnotherInstitution.addEventListener("change", toggleFields);
    });
</script>