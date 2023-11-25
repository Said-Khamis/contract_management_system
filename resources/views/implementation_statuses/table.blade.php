<div class="table-responsive">
    <table class="table" id="implementationStatuses-table">
        <thead>
        <tr>
            <th>Id</th>
        <th>Contract Id</th>
        <th>Comment</th>
        <th>Percent</th>
        <th>Created By</th>
        <th>Updated By</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($implementationStatuses as $implementationStatus)
            <tr>
                <td>{{ $implementationStatus->id }}</td>
            <td>{{ $implementationStatus->contract_id }}</td>
            <td>{{ $implementationStatus->comment }}</td>
            <td>{{ $implementationStatus->percent }}</td>
            <td>{{ $implementationStatus->created_by }}</td>
            <td>{{ $implementationStatus->updated_by }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['implementationStatuses.destroy', $implementationStatus->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('implementationStatuses.show', [$implementationStatus->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('implementationStatuses.edit', [$implementationStatus->id]) }}"
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
