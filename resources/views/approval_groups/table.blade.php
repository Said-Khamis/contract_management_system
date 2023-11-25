<table class="table">
    <thead>
    <tr>
        <td>Nam</td>
        <td>Rank</td>
        <td>Description</td>
    </tr>
    </thead>
    <tbody>
    @forelse($approvalGroups as $approvalGroup)
        <tr>
            <td>{{$approvalGroup->name}}</td>
            <td>{{$approvalGroup->rank}}</td>
            <td>{{$approvalGroup->description}}</td>
        </tr>
    @empty

    @endforelse
    </tbody>
</table>
