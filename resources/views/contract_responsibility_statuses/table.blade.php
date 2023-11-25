<div class="table-responsive">
    <table class="table" id="contractResponsibilityStatuses-table">
        <thead>
        <tr>
            <th>Responsibility Id</th>
        <th>Status</th>
        <th>Comment</th>
        <th>Status Updated At</th>
        <th>Created By</th>
        <th>Updated By</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($contractResponsibilityStatuses as $contractResponsibilityStatus)
            <tr>
                <td>{{ $contractResponsibilityStatus->responsibility_id }}</td>
            <td>{{ $contractResponsibilityStatus->status }}</td>
            <td>{{ $contractResponsibilityStatus->comment }}</td>
            <td>{{ $contractResponsibilityStatus->status_updated_at }}</td>
            <td>{{ $contractResponsibilityStatus->created_by }}</td>
            <td>{{ $contractResponsibilityStatus->updated_by }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['contractResponsibilityStatuses.destroy', $contractResponsibilityStatus->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('contractResponsibilityStatuses.show', [$contractResponsibilityStatus->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('contractResponsibilityStatuses.edit', [$contractResponsibilityStatus->id]) }}"
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
