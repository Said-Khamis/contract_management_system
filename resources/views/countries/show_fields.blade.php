
<table class="table table-borderless align-middle mb-0">
    <tbody>
    <tr>
        <td class="fw-medium">Name</td><td>{{ ucwords($country->name) }}</td>
    </tr>
    <tr>
        <td class="fw-medium">Code</td><td>{{ strtoupper( $country->code) }}</td>
    </tr>
    @if($country->hasRegion)
        <tr>
            <td class="fw-medium">Has Region</td><td>True</td>
        </tr>
    @elseif($country->hasState)
        <tr>
            <td class="fw-medium">Has State</td><td>True</td>
        </tr>
    @else
        <tr>
            <td class="fw-medium">Has City</td><td>True</td>
        </tr>
    @endif
    </tbody>
</table>


