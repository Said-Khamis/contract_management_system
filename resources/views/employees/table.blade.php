<div class="table-responsive">
    <table style="width: 100%; border-spacing: 0" class="table table-sm table-striped table-bordered table-nowrap align-middle mb-0" id="employees-table">
        <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Employee ID</th>
            <th>NIN</th>
            <th>Employment Date</th>
            <th>Duty Station</th>
            <th>Designation</th>
            <th>Department</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($employees as $employee)
            <tr>
                <td width="40" class="text-center">{{ $loop->index+1 }}</td>
                <td>{{ $employee->employee_id }}</td>
                <td>{{ $employee->nin }}</td>
                <td>{{ date('d-m-Y', strtotime($employee->employment_date)) }}</td>
                <td>{{ $employee->duty_station }}</td>
                <td>{{ $employee->designation->title }}</td>
                <td>{{ $employee->department->name }}</td>
                <td width="120">
                    <div class='btn-group'>
                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ri-more-fill align-middle"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <button class="dropdown-item edit-item-btn data-modal" data-url="{{ route('employees.edit', [$employee->id]) }}">
                                    <i class="ri-pencil-fill align-bottom me-2 text-muted">
                                    </i> Edit
                                </button>
                            </li>
                            <li>
                                {!! Form::open(['route' => ['employees.destroy', $employee->id], 'method' => 'delete']) !!}
                                    {!! Form::button('<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete', ['type' => 'submit', 'class' => 'dropdown-item edit-item-btn', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                {!! Form::close() !!}
                            </li>
                        </ul>

                        <button type="button" class="btn btn-success btn-sm data-modal" data-url="{{ route('employees.show', [$employee->id]) }}"><i class="ri-eye-fill"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
