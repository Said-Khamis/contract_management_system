<div class="table-responsive">
    <table class="table" id="amendmends-table">
        <thead>
        <tr>
            <th>Id</th>
        <th>Date Of Amendment</th>
        <th>Reasons</th>
        <th>Attachement Id</th>
        <th>Contract Id</th>
        <th>Created By</th>
        <th>Updated By</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($amendmends as $amendmend)
            <tr>
                <td>{{ $amendmend->id }}</td>
            <td>{{ $amendmend->date_of_amendment }}</td>
            <td>{{ $amendmend->reasons }}</td>
            <td>{{ $amendmend->attachement_id }}</td>
            <td>{{ $amendmend->contract_id }}</td>
            <td>{{ $amendmend->created_by }}</td>
            <td>{{ $amendmend->updated_by }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['amendmends.destroy', $amendmend->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('amendmends.show', [$amendmend->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('amendmends.edit', [$amendmend->id]) }}"
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
