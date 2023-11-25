    <tr>
        <td class="fw-medium">Employee ID</td><td>{{ $employee->employee_id }}</td>
    </tr>

    <tr>
        <td class="fw-medium">NIN</td><td>{{ $employee->nin }}</td>
    </tr>

    <tr>
        <td class="fw-medium">Employment Date</td><td>{{ date('d-m-Y', strtotime($employee->employment_date)) }}</td>
    </tr>

    <tr>
        <td class="fw-medium">Duty Station</td><td>{{ $employee->duty_station }}</td>
    </tr>

    <tr>
        <td class="fw-medium">Designation</td><td>{{ $employee->designation->title }}</td>
    </tr>

    <tr>
        <td class="fw-medium">Department</td><td>{{ $employee->department->name }}</td>
    </tr>

    <tr>
        <td class="fw-medium">Date Added</td><td>{{ dateAdded($employee) }}</td>
    </tr>

    <tr>
        <td class="fw-medium">Last modified</td><td>{{ lastModified($employee) }}</td>
    </tr>