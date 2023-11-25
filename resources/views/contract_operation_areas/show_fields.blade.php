<table class="table table-borderless align-middle mb-0">
    <tbody>
    <!-- Parent Area Field show if exist-->
    @if($contractOperationArea->contractOperationArea != null)
        <tr>
            <td class="fw-medium">Parent Area</td>
            <td>{{ $contractOperationArea->contractOperationArea->area }}</td>
        </tr>
    @endif
    <!-- Area Field -->
    <tr>
        <td class="fw-medium">Area</td>
        <td>{{ $contractOperationArea->area}}</td>
    </tr>
    <!-- Details Field -->
    <tr>
        <td class="fw-medium">Details</td>
        <td>{{ $contractOperationArea->details}}</td>
    </tr>
    <!-- Created Field -->
    <tr>
        <td class="fw-medium">Date added</td>
        <td>{{ dateAdded($contractOperationArea) }}</td>
    </tr>
    <!-- Last modified Field -->
    <tr>
        <td class="fw-medium">Last modified</td>
        <td>{{ lastModified($contractOperationArea) }}</td>
    </tr>
    </tbody>
</table>
