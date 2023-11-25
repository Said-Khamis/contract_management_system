<!-- Id Field -->
<div class="col-sm-12">
    {!! Form::label('id', 'Id:') !!}
    <p>{{ $employeeDesignation->id }}</p>
</div>

<!-- Employee Id Field -->
<div class="col-sm-12">
    {!! Form::label('employee_id', 'Employee Id:') !!}
    <p>{{ $employeeDesignation->employee_id }}</p>
</div>

<!-- Designation Id Field -->
<div class="col-sm-12">
    {!! Form::label('designation_id', 'Designation Id:') !!}
    <p>{{ $employeeDesignation->designation_id }}</p>
</div>

<!-- Active Field -->
<div class="col-sm-12">
    {!! Form::label('active', 'Active:') !!}
    <p>{{ $employeeDesignation->active }}</p>
</div>

<!-- Created By Field -->
<div class="col-sm-12">
    {!! Form::label('created_by', 'Created By:') !!}
    <p>{{ $employeeDesignation->created_by }}</p>
</div>

<!-- Updated By Field -->
<div class="col-sm-12">
    {!! Form::label('updated_by', 'Updated By:') !!}
    <p>{{ $employeeDesignation->updated_by }}</p>
</div>

