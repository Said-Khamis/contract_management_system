
<table class="table table-borderless align-middle mb-0">
    <tbody>
    <tr>
        <td class="fw-medium">Name</td><td>{{ ucwords($ward->name) }}</td>
    </tr>
    <tr>
        <td class="fw-medium">District Name</td><td>{{ ucwords($ward->district->name) }}</td>
    </tr>
    <tr>
        <td class="fw-medium">Date Added</td><td>{{ dateAdded($ward) }}</td>
    </tr>
    <tr>
        <td class="fw-medium">Last modified</td><td>{{ lastModified($ward) }}</td>
    </tr>
    </tbody>
</table>


