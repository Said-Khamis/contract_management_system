<div class="table-responsive">
    <table class="table" id="contractTerminations-table">
        <thead>
        <tr>
            <th>Id</th>
        <th>Date Of Termination</th>
        <th>Reasons</th>
        <th>Attachement Id</th>
        <th>Created By</th>
        <th>Updated By</th>
        <th>Contract Id</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($contractTerminations as $contractTermination)
            <tr>
                <td>{{ $contractTermination->id }}</td>
            <td>{{ $contractTermination->date_of_termination }}</td>
            <td>{{ $contractTermination->reasons }}</td>
            <td>{{ $contractTermination->attachement_id }}</td>
            <td>{{ $contractTermination->created_by }}</td>
            <td>{{ $contractTermination->updated_by }}</td>
            <td>{{ $contractTermination->contract_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['contractTerminations.destroy', $contractTermination->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('contractTerminations.show', [$contractTermination->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('contractTerminations.edit', [$contractTermination->id]) }}"
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
