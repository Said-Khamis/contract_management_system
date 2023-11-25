<div class="table-responsive">
    <table class="table table-sm mb-0" id="approvals-table">
        <thead>
        <tr>
            <th>Date Created</th>
            <th>Current Approver</th>
            <th>Created By</th>
            <th>Approved</th>
            <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($approvals as $approval)
            <tr class="{{isApprovalRejected($approval->status) ? 'bg-red-lt' : '' }}">
                <td>{{ $approval->created_at }}</td>
                <td>{{ $approval->current_approver }}</td>
                <td>{{ $approval->creator}}</td>
                <td>
                    <span class="badge bg-{{ $approval->is_approved ? 'green' : 'yellow' }}-lt">{{ $approval->is_approved ? 'Yes' : 'No' }}</span>
                </td>
                <td class="bg-{{getApprovalStatusColor($approval->status)}}-lt">{{getApprovalStatus($approval->status)}}</td>

                <td width="120">
                    {!! Form::open(['route' => ['approvals.destroy', $approval->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('approvals.show', [$approval->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('approvals.edit', [$approval->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-edit"></i>
                        </a>
                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
