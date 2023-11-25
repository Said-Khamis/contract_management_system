<div class="table-responsive">
    <table class="table" id="employeeDepartments-table">
        <thead>
        <tr>
            <th>Department Id</th>
        <th>Created By</th>
        <th>Updated By</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($employeeDepartments as $employeeDepartment)
            <tr>
                <td>{{ $employeeDepartment->department_id }}</td>
            <td>{{ $employeeDepartment->created_by }}</td>
            <td>{{ $employeeDepartment->updated_by }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['employeeDepartments.destroy', $employeeDepartment->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('employeeDepartments.show', [$employeeDepartment->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('employeeDepartments.edit', [$employeeDepartment->id]) }}"
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
