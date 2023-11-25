<div class="table-responsive p-2">
    <table style="width: 100%; border-spacing: 0" class="table table-sm table-striped table-nowrap align-middle mb-0" id="contractParties-table">
        <thead>
        <tr>
            <th>Name</th>
            <th>Category</th>
            <th>Type</th>
            <th>Location</th>
            <th>Is Local</th>
{{--            <th colspan="3">Action</th>--}}
        </tr>
        </thead>
        <tbody>
        @foreach($contractParties as $contractParty)
            <tr>
                <td>{{ $contractParty->institution->name }}</td>
                <td>
                    {{ $contractParty->institution->is_sector ? 'Sector':'Institution' }}
                </td>
                <td>{{ $contractParty->is_main ? 'Main':'Other' }}</td>
                <td>{{ $contractParty->is_home }}</td>
                <td>{{ $contractParty->is_local ? 'Yes':'No'  }}</td>
{{--                <td width="120">--}}
{{--                    {!! Form::open(['route' => ['contractParties.destroy', $contractParty->id], 'method' => 'delete']) !!}--}}
{{--                    <div class='btn-group'>--}}
{{--                        <a href="{{ route('contractParties.show', [$contractParty->id]) }}"--}}
{{--                           class='btn btn-default btn-xs'>--}}
{{--                            <i class="far fa-eye"></i>--}}
{{--                        </a>--}}
{{--                        <a href="{{ route('contractParties.edit', [$contractParty->id]) }}"--}}
{{--                           class='btn btn-default btn-xs'>--}}
{{--                            <i class="far fa-edit"></i>--}}
{{--                        </a>--}}
{{--                        {!! Form::button('<i class="far fa-trash-alt"></i>', ['type' => 'submit', 'class' => 'btn btn-danger btn-xs', 'onclick' => "return confirm('Are you sure?')"]) !!}--}}
{{--                    </div>--}}
{{--                    {!! Form::close() !!}--}}
{{--                </td>--}}
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
