
<table class="table table-borderless align-middle mb-0">
    <tbody>
        <tr>
            <td class="fw-medium">Institution Name</td><td>{{ $institution->name }}</td>
        </tr>
        <tr>
            <td class="fw-medium">Abbreviation</td><td>{{ $institution->abbreviation }}</td>
        </tr>
        <tr>
            <td class="fw-medium">Is Local</td><td>{{ ($institution->is_local)? 'Yes': 'No' }}</td>
        </tr>
        <tr>
            <td class="fw-medium">Is Sector</td><td>{{ ($institution->is_sector)? 'Yes': 'No' }}</td>
        </tr>
        <tr>
            <td class="fw-medium">Parent Institution</td><td>{{ ($institution->parent)? $institution->parent->name: 'N/A' }}</td>
        </tr>
        <tr>
            <td class="fw-medium">Date Added</td><td>{{ dateAdded($institution) }}</td>
        </tr>
        <tr>
            <td class="fw-medium">Last modified</td><td>{{ lastModified($institution) }}</td>
        </tr>
    </tbody>
</table>