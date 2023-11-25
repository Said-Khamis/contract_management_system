<table class="table table-sm mb-0">
    <thead>
        <tr>
            <th>Name</th>
            <th>Type</th>
            <th>Enabled</th>
            <th>Auto</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse($workFlows as $workFlow)
            <tr>
                <td>{{$workFlow->name}}</td>
                <td>{{$workFlow->type}}</td>
                <td>
                    @if($workFlow->is_enabled)
                        <i class="fa fa-toggle-on text-green"></i> Yes
                    @else
                        <i class="fa fa-toggle-off text-danger"></i> No
                    @endif
                </td>
                <td>
                    @if($workFlow->is_auto_approve)
                        <i class="fa fa-toggle-on text-green"></i> Yes
                    @else
                        <i class="fa fa-toggle-off text-danger"></i> No
                    @endif
                </td>
                <td width="120">
                    @include('approval_work_flows.datatables_actions')
                </td>
            </tr>
        @empty
            no data
        @endforelse
    </tbody>
</table>
