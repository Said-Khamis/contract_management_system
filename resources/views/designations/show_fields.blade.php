<table class="table table-borderless align-middle mb-0">
<<<<<<< HEAD
=======
    <tbody>
>>>>>>> e245a56791587c8015ff2cdeb7cd8d1ca94cc162
    <tr>
        <td class="fw-medium">Name</td><td>{{ ucwords($designations->title) }}</td>
    </tr>
    <tr>
        <td class="fw-medium">Descriptions</td><td>{{ strtoupper( $designations->description) }}</td>
    </tr>
    <tr>
        <td class="fw-medium">Date Added</td><td>{{ date('M d, Y', strtotime($designations->created_at)) }}</td>
    </tr>
    <tr>
<<<<<<< HEAD
        <td class="fw-medium">Date Added</td><td>{{ dateAdded($designations) }}</td>
    </tr>
    <tr>
        <td class="fw-medium">Last modified</td><td>{{ lastModified($designations) }}</td>
=======
        <td class="fw-medium">Last modified</td><td>{{ date('M d, Y', strtotime($designations->updated_at)) }}</td>
>>>>>>> e245a56791587c8015ff2cdeb7cd8d1ca94cc162
    </tr>
    </tbody>
</table>


