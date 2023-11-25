<table class="table table-borderless align-middle mb-0">
    <tbody>
    <tr>
        <td class="fw-medium">Details</td>
        <td>{{ $contractNotice->details}}</td>
    </tr>
    <!-- Created Field -->
    <tr>
        <td class="fw-medium">Date added</td>
        <td>{{ dateAdded($contractNotice) }}</td>
    </tr>
    <!-- Last modified Field -->
    <tr>
        <td class="fw-medium">Last modified</td>
        <td>{{ lastModified($contractNotice) }}</td>
    </tr>
    </tbody>
</table>
