<table class="table table-borderless align-middle mb-0">
    <tbody>
        <!-- Parent Category Field show if exist-->
        @if($category->category != null)
            <tr>
                <td class="fw-medium">Parent Category</td>
                <td>{{ $category->category->name }}</td>
            </tr>
        @endif
        <!-- Name Field -->
        <tr>
            <td class="fw-medium">Name</td>
            <td>{{ $category->name }}</td>
        </tr>
        <!-- Code Field -->
        <tr>
            <td class="fw-medium">Code</td>
            <td>{{ $category->code }}</td>
        </tr>
        <!-- Description Field -->
        <tr>
            <td class="fw-medium">Description</td>
            <td>{{ $category->description }}</td>
        </tr>
        <!-- Created Field -->
        <tr>
            <td class="fw-medium">Date added</td>
            <td>{{ dateAdded($category) }}</td>
        </tr>
        <!-- Last modified Field -->
        <tr>
            <td class="fw-medium">Last modified</td>
            <td>{{ lastModified($category) }}</td>
        </tr>
    </tbody>
</table>
