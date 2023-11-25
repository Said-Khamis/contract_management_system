<div class="table-responsive">
    <table class="table  table-sm mb-0" id="states-table">
        <thead>
            <tr>
                <th>Sno</th>
                <th>Name</th>
                <th>Country</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($states as $state)
            <tr>
                <td>{{ $loop->index+1 }}</td>
                <td>{{ $state->name }}</td>
                <td>{{ $state->country->name }}</td>
                <td width="120">
                    <div class='btn-group'>
                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ri-more-fill align-middle"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <button class="dropdown-item edit-item-btn data-modal" data-url="{{ route('states.edit', [$state->id]) }}">
                                    <i class="ri-pencil-fill align-bottom me-2 text-muted">
                                    </i> Edit
                                </button>
                            </li>
                            <li>
                                {!! Form::open(['route' => ['states.destroy', $state->id], 'method' => 'delete']) !!}
                                {!! Form::button('<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete', ['type' => 'submit', 'class' => 'dropdown-item edit-item-btn', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                {!! Form::close() !!}
                            </li>
                        </ul>

                        <button type="button" class="btn btn-success btn-sm data-modal" data-url="{{ route('states.show', [$state->id]) }}"><i class="ri-eye-fill"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
