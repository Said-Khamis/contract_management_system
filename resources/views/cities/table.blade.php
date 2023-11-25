<div class="table-responsive">
    <table class="table" id="cities-table">
        <thead>
        <tr>
            <th width="30">#</th>
            <th>Name</th>
        <th>Country</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($cities as $city)
            <tr>
                <td>{{ $loop->index+1 }}</td>
                <td>{{ $city->name }}</td>
            <td>{{ $city->country->name }}</td>
                <td width="80">
                    <div class='btn-group'>
                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ri-more-fill align-middle"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <button class="dropdown-item edit-item-btn data-modal" data-url="{{ route('cities.edit', [$city->id]) }}">
                                    <i class="ri-pencil-fill align-bottom me-2 text-muted">
                                    </i> Edit
                            </button>

                            </li>
                        <li>
                    {!! Form::open(['route' => ['cities.destroy', $city->id], 'method' => 'delete']) !!}
                        {!! Form::button('<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete', ['type' => 'submit', 'class' => 'dropdown-item edit-item-btn', 'data-confirm-delete' =>'true']) !!}

                    {!! Form::close() !!}
                        </li>
                </ul>
                <button type="button" class="btn btn-success btn-sm data-modal" data-url="{{ route('cities.show', [$city->id]) }}">
                    <i class="ri-eye-fill">
                    </i>
                </button>
                </div>
            </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
