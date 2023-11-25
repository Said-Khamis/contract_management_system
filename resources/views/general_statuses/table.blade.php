<div class="table-responsive">
    <table class="table" id="generalStatuses-table">
        <thead>
        <tr>
            <th>Id</th>
        <th>Contract Id</th>
        <th>Created By</th>
        <th>Updated By</th>
        <th>Comment</th>
        <th>Percent</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($generalStatuses as $generalStatus)
            <tr>
                <td>{{ $generalStatus->id }}</td>
            <td>{{ $generalStatus->contract_id }}</td>
            <td>{{ $generalStatus->created_by }}</td>
            <td>{{ $generalStatus->updated_by }}</td>
            <td>{{ $generalStatus->comment }}</td>
            <td>{{ $generalStatus->percent }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['generalStatuses.destroy', $generalStatus->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('generalStatuses.show', [$generalStatus->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('generalStatuses.edit', [$generalStatus->id]) }}"
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
