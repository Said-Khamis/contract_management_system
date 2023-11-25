
<table class="table table-borderless align-middle mb-0">
    <tbody>
    <tr>
        <td class="fw-medium">Name</td><td>{{ ucwords($district->name) }}</td>
    </tr>
    <tr>
        <td class="fw-medium">Region Name</td><td>{{ ucwords($district->region->name) }}</td>
    </tr>
    <tr>
        <td class="fw-medium">Date Added</td><td>{{ dateAdded($district) }}</td>
    </tr>
    <tr>
        <td class="fw-medium">Last modified</td><td>{{ lastModified($district) }}</td>
    </tr>
    </tbody>
</table>

