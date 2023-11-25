<table class="table table-borderless align-middle mb-0">
    <tbody>
    <!-- Area Field -->
    <tr>
        <td class="fw-medium">Title</td>
        <td>{{ $contractDelivery->title}}</td>
    </tr>
    <!-- Details Field -->
    <tr>
        <td class="fw-medium">Details</td>
        <td>{{ $contractDelivery->details}}</td>
    </tr>
    <tr>
        <td class="fw-medium">More</td>
        <td>
            {{ $contractDelivery->type }}  :
            @if($contractDelivery->annual_event==1)
                {{ $contractDelivery->unit }}   {{ \Carbon\Carbon::parse($contractDelivery->time)->format('jS M') }} each year
            @elseif($contractDelivery->annual_event==0 && $contractDelivery->unit !=='each')
                {{ $contractDelivery->unit }}    {{$contractDelivery->time}}
            @else
                {{ $contractDelivery->unit }}    after  {{ $contractDelivery->duration }} months  from date {{ $contractDelivery->time }}
            @endif</td>
    </tr>
    <!-- Created Field -->
    <tr>
        <td class="fw-medium">Date added</td>
        <td>{{ dateAdded($contractDelivery) }}</td>
    </tr>
    <!-- Last modified Field -->
    <tr>
        <td class="fw-medium">Last modified</td>
        <td>{{ lastModified($contractDelivery) }}</td>
    </tr>
    </tbody>
</table>
