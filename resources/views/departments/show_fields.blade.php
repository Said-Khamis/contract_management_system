    <tr>
        <td class="fw-medium">Name</td><td>{{ $department->name }}</td>
    </tr>

    <tr>
        <td class="fw-medium">Code</td><td>{{ $department->code }}</td>
    </tr>

    <tr>
        <td class="fw-medium">Description</td><td>{{ $department->description }}</td>
    </tr>

    <tr>
        <td class="fw-medium">Date Added</td><td>{{ dateAdded($department) }}</td>
    </tr>
    <tr>
        <td class="fw-medium">Last modified</td><td>{{ lastModified($department) }}</td>
    </tr>