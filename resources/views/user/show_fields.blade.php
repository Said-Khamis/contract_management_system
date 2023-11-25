
<table class="table table-striped table-bordered align-middle mb-0">
    <tbody>
        <tr>
            <td class="fw-medium">Full name</td><td>{{ isset($user->middle_name) ? ucfirst($user->first_name) . " " .  ucfirst($user->middle_name) . " " . ucfirst($user->last_name) : ucfirst($user->first_name) . " " . ucfirst($user->last_name) }}</td>
        </tr>
        <tr>
            <td class="fw-medium">Email</td><td>{{ $user->email }}</td>
        </tr>
        <tr>
            <td class="fw-medium">User Role</td>
            <td><span class="badge {{$user->roles()->first()->name == "super-admin" || $user->roles()->first()->name == "admin" ? 'bg-opacity-75 bg-primary' : 'bg-opacity-50 bg-info text-dark'}}">{{$user->roles()->first()->name}}</span></td>
        </tr>
        <tr>
            <td class="fw-medium">Designation</td><td>{{ !is_null($user->designation) ? $user->designation->description : "" }}</td>
        </tr>
        <tr>
            <td class="fw-medium">Department</td><td>{{ !is_null($user->department()) ? $user->department()->description : "" }}</td>
        </tr>
        <tr>
            <td class="fw-medium">Status</td>
            <td><span class="badge bg-opacity-75 {{$user->is_active ? 'bg-success' : 'bg-danger'}}">{{$user->is_active ? "ACTIVE" : "INACTIVE"}}</span></td>
        </tr>
        <tr>
            <td class="fw-medium">Date Added</td><td>{{ dateAdded($user) }}</td>
        </tr>
        <tr>
            <td class="fw-medium">Last modified</td><td>{{ lastModified($user) }}</td>
        </tr>
    </tbody>
</table>
