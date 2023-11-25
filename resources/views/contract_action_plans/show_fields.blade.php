<table class="table table-borderless align-middle mb-0">
    <tbody>
    <tr>
        <td class="fw-medium">Name</td>
        <td>{{ $actionPlan->name}}</td>
    </tr>
    <!-- Created Field -->
    <tr>
        <td class="fw-medium">Date added</td>
        <td>{{ dateAdded($actionPlan) }}</td>
    </tr>
    <!-- Last modified Field -->
    <tr>
        <td class="fw-medium">Last modified</td>
        <td>{{ lastModified($actionPlan) }}</td>
    </tr>
    </tbody>
</table>
