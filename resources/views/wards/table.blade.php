<div class="table-responsive">
    <table class="table table-sm table-nowrap mb-0"
           style="width: 100%;" id="wards-table">
        <thead>
        <tr>
            <th width="30">#</th>
            <th>Name</th>
        <th>District</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($wards as $ward)
            <tr>
                <td>{{ $loop->index+1  }}</td>
                <td>{{ ucwords($ward->name) }}</td>
            <td>{{ ucwords($ward->district->name) }}</td>
                <td width="80">

                    <div class='btn-group'>
                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ri-more-fill align-middle"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <button class="dropdown-item edit-item-btn data-modal" data-url="{{ route('wards.edit', [$ward->id]) }}">
                                    <i class="ri-pencil-fill align-bottom me-2 text-muted">
                                    </i> Edit
                                </button>
                            </li>
                            <li>
                                {!! Form::open(['route' => ['wards.destroy', $ward->id], 'method' => 'delete']) !!}
                                {!! Form::button('<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete', ['type' => 'submit', 'class' => 'dropdown-item edit-item-btn', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                {!! Form::close() !!}
                            </li>
                        </ul>

                        <button type="button" class="btn btn-success btn-sm data-modal" data-url="{{ route('wards.show', [$ward->id]) }}"><i class="ri-eye-fill"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
