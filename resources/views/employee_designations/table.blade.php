<div class="table-responsive">
    <table class="table" id="employeeDesignations-table">
        <thead>
        <tr>
            <th>Id</th>
        <th>Employee Id</th>
        <th>Designation Id</th>
        <th>Active</th>
        <th>Created By</th>
        <th>Updated By</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($employeeDesignations as $employeeDesignation)
            <tr>
                <td>{{ $employeeDesignation->id }}</td>
            <td>{{ $employeeDesignation->employee_id }}</td>
            <td>{{ $employeeDesignation->designation_id }}</td>
            <td>{{ $employeeDesignation->active }}</td>
            <td>{{ $employeeDesignation->created_by }}</td>
            <td>{{ $employeeDesignation->updated_by }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['employeeDesignations.destroy', $employeeDesignation->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('employeeDesignations.show', [$employeeDesignation->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('employeeDesignations.edit', [$employeeDesignation->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
