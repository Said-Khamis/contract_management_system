<!-- Employee Id Field -->
<div class="form-group col-sm-6 mt-3">
    {!! Form::label('employee_id', 'Employee ID:') !!}
    {!! Form::number('employee_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Nin Field -->
<div class="form-group col-sm-6 mt-3">
    {!! Form::label('nin', 'NIN (NIDA Number):') !!}
    {!! Form::text('nin', null, ['class' => 'form-control']) !!}
</div>

<!-- Employment Date Field -->
<div class="form-group col-sm-6 mt-3">
    {!! Form::label('employment_date', 'Employment Date:') !!}
    {!! Form::date('employment_date', null, ['class' => 'form-control','id'=>'employment_date']) !!}
</div>

@push('custom-scripts')
    <script type="text/javascript">
        $('#employment_date').datetimepicker({
            format: 'YYYY-MM-DD',
            useCurrent: true,
            sideBySide: true
        })
    </script>
@endpush

<!-- Duty Station Field -->
<div class="form-group col-sm-6 mt-3">
    {!! Form::label('duty_station', 'Duty Station:') !!}
    {!! Form::text('duty_station', null, ['class' => 'form-control']) !!}
</div>

<!-- Department Id Field -->
<div class="form-group col-sm-6 mt-3">
    {!! Form::label('department_id', 'Department:') !!}
    {!! Form::select('department_id', getPluckedDepartments(), null, ['class' => 'form-control select2 py-2', 'placeholder'=>'Select Department']) !!}
</div>

<!-- Designation Id Field -->
<div class="form-group col-sm-6 mt-3">
    {!! Form::label('designation_id', 'Designation:') !!}
    {!! Form::select('designation_id', getPluckedDesignations(), null, ['class' => 'form-control select2 py-2', 'placeholder'=>'Select Designation']) !!}
</div>