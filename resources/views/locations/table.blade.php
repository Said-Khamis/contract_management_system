<div class="table-responsive">
    <table class="table" id="locations-table">
        <thead>
        <tr>
            <th>Settlement</th>
        <th>Ward Id</th>
        <th>District Id</th>
        <th>City Id</th>
        <th>Region Id</th>
        <th>State Id</th>
        <th>Created By</th>
        <th>Updated By</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($locations as $location)
            <tr>
                <td>{{ $location->settlement }}</td>
            <td>{{ $location->ward_id }}</td>
            <td>{{ $location->district_id }}</td>
            <td>{{ $location->city_id }}</td>
            <td>{{ $location->region_id }}</td>
            <td>{{ $location->state_id }}</td>
            <td>{{ $location->created_by }}</td>
            <td>{{ $location->updated_by }}</td>
                <td width="120">
                    {!! Form::open(['route' => ['locations.destroy', $location->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        <a href="{{ route('locations.show', [$location->id]) }}"
                           class='btn btn-default btn-xs'>
                            <i class="far fa-eye"></i>
                        </a>
                        <a href="{{ route('locations.edit', [$location->id]) }}"
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
