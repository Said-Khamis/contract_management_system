<div class="table-responsive">
    <table style="width: 100%; border-spacing: 0" class="table table-sm table-striped table-bordered table-nowrap mb-0" id="designations-table">
        <thead>
            <tr>
                <th>Sno</th>
                <th>Name</th>
                <th>Descriptions</th>
                <th colspan="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($designations as $designation)
            <tr>
                <td>{{ $loop->index+1 }}</td>
                <td>{{ $designation->title }}</td>
                <td>{{ $designation->description }}</td>
                <td width="120">
                    <div class='btn-group'>
                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ri-more-fill align-middle"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <button class="dropdown-item edit-item-btn data-modal" data-url="{{ route('designations.edit', [$designation->id]) }}">
                                    <i class="ri-pencil-fill align-bottom me-2 text-muted">
                                    </i> Edit
                                </button>
                            </li>
                            <li>
                                {!! Form::open(['route' => ['designations.destroy', $designation->id], 'method' => 'delete']) !!}
                                {!! Form::button('<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete', ['type' => 'submit', 'class' => 'dropdown-item edit-item-btn', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                {!! Form::close() !!}
                            </li>
                        </ul>

                        <button type="button" class="btn btn-success btn-sm data-modal" data-url="{{ route('designations.show', [$designation->id]) }}"><i class="ri-eye-fill"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach


        </tbody>
    </table>
</div>
