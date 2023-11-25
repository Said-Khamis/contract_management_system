<table>
    <tr>
        <th>Field</th>
        <th>Value</th>
    </tr>
    <tr>
        <td>Name:</td>
        <td>{{ $state->name }}</td>
    </tr>
    <tr>
        <td>Descriptions:</td>
        <td>{{ $state->description }}</td>
    </tr>
    <tr>
        <td class="fw-medium">Date Added</td><td>{{ dateAdded($state) }}</td>
    </tr>
    <tr>
        <td class="fw-medium">Last modified</td><td>{{ lastModified($state) }}</td>
    </tr>
</table>
