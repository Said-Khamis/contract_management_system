<table class="table table-borderless align-middle mb-0">
    <tbody>
    <!-- Parent Objective Field show if exist-->
    @if($contractObjective->contractObjective != null)
        <tr>
            <td class="fw-medium">Parent Area</td>
            <td>{{ $contractObjective->contractObjective->details }}</td>
        </tr>
    @endif
    <!-- Details Field -->
    <tr>
        <td class="fw-medium">Details</td>
        <td>{{ $contractObjective->details}}</td>
    </tr>
    <!-- Created Field -->
    <tr>
        <td class="fw-medium">Date added</td>
        <td>{{ dateAdded($contractObjective) }}</td>
    </tr>
    <!-- Last modified Field -->
    <tr>
        <td class="fw-medium">Last modified</td>
        <td>{{ lastModified($contractObjective) }}</td>
    </tr>
    </tbody>
</table>
