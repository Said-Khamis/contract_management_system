<table class="table table-borderless align-middle mb-0">
    <tbody>
    <!-- Parent Institute Field show if exist-->
    @if($contractSector->institute->institute != null)
        <tr>
            <td class="fw-medium">Parent Sector</td>
            <td>{{ $contractSector->institute->institute->name }}</td>
        </tr>
    @endif
    <!-- Name Field -->
    <tr>
        <td class="fw-medium">Sector</td>
        <td>{{ $contractSector->institute->name}}</td>
    </tr>
    <!-- Owner Field -->
    <tr>
        <td class="fw-medium">Is Contract Owner</td>
        <td>{{ ($contractSector->is_owner) ? 'Yes': 'No' }}</td>
    </tr>
    <!-- Created Field -->
    <tr>
        <td class="fw-medium">Date assigned</td>
        <td>{{ dateAdded($contractSector) }}</td>
    </tr>
    <!-- Last modified Field -->
    <tr>
        <td class="fw-medium">Last modified</td>
        <td>{{ lastModified($contractSector) }}</td>
    </tr>
    </tbody>
</table>
