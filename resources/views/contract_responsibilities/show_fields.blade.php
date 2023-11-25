<table class="table table-borderless align-middle mb-0">
    <tbody>
    <!-- Party Parent Field show if exist-->
{{--    @if($contractResponsibility->party->institution->institute != null)--}}
{{--        <tr>--}}
{{--            <td class="fw-medium">Contract Party Parent</td>--}}
{{--            <td>{{ $contractResponsibility->party->institution->institute->name }}</td>--}}
{{--        </tr>--}}
{{--    @endif--}}
{{--    <!-- Name Field -->--}}
{{--    <tr>--}}
{{--        <td class="fw-medium">Contract Party</td>--}}
{{--        <td>{{ $contractResponsibility->party->institution->name}}</td>--}}
{{--    </tr>--}}
    <!-- Details Field -->
    <tr>
        <td class="fw-medium">Details</td>
        <td>{{ $contractResponsibility->details }}</td>
    </tr>
    <!-- Start time Field -->
{{--    <tr>--}}
{{--        <td class="fw-medium">Start date</td>--}}
{{--        <td>{{ date('M d, Y', strtotime($contractResponsibility->start_time)) }}</td>--}}
{{--    </tr>--}}
{{--    <!-- End time Field -->--}}
{{--    <tr>--}}
{{--        <td class="fw-medium">End date</td>--}}
{{--        <td>{{ date('M d, Y', strtotime($contractResponsibility->end_time)) }}</td>--}}
{{--    </tr>--}}
    <!-- Created Field -->
    <tr>
        <td class="fw-medium">Date added</td>
        <td>{{ dateAdded($contractResponsibility) }}</td>
    </tr>
    <!-- Last modified Field -->
    <tr>
        <td class="fw-medium">Last modified</td>
        <td>{{ lastModified($contractResponsibility) }}</td>
    </tr>
    </tbody>
</table>
