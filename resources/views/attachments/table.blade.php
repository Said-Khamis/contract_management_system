<div class="table-responsive">
    <table class="table" id="attachments-table">
        <thead>
        <tr>
            <th>Description</th>
        <th>Url</th>
        <th>Created By</th>
        <th>Updated By</th>
        <th>Contract Id</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($attachments as $attachment)
            <tr>
                <td>{{ $attachment->description }}</td>
            <td>{{ $attachment->url }}</td>
            <td>{{ $attachment->created_by }}</td>
            <td>{{ $attachment->updated_by }}</td>
            <td>{{ $attachment->contract_id }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['attachments.destroy', $attachment->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('attachments.show', [$attachment->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('attachments.edit', [$attachment->id]) }}"
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
