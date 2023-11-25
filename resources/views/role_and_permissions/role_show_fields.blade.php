<table class="table table-striped table-bordered align-middle mb-0">
    <tbody>
    <tr>
        <td class="fw-medium">Role</td>
        <td>{{ $role->name }}</td>
    </tr>
    @if(!is_null($role->institution))
        <tr>
            <td class="fw-medium">Institution Name</td>
            <td>{{ $role->institution->name }}</td>
        </tr>
    @endif
    <tr>
        <td class="fw-medium">Permissions</td>
        <td class="text-primary">
            @foreach($role->permissions as $permission)
                {{$permission->name.' | '}}
            @endforeach
        </td>
    </tr>
    <tr>
        <td class="fw-medium">Date Added</td><td>{{ dateAdded($role) }}</td>
    </tr>
    <tr>
        <td class="fw-medium">Last modified</td><td>{{ lastModified($role) }}</td>
    </tr>
    </tbody>
</table>
