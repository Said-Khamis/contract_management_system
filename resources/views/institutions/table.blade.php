<div class="table-responsive">
    <table style="width: 100%; border-spacing: 0" class="table table-sm table-striped table-bordered table-nowrap align-middle mb-0" id="institutions-table">
        <thead>
            <tr>
            <tr>
                <th class="text-center">#</th>
                <th>Name</th>
                <th>Abbreviation</th>
                <th>Sector</th>
                <th width="3">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($institutions as $institution)
            <tr>
                <td width="40" class="text-center">{{ $loop->index+1 }}</td>
                <td>{{ $institution->name }}</td>
                <td>{{ $institution->abbreviation }}</td>
                <td>{{ !is_null($institution->sector) ? $institution->sector->name : ""  }}</td>
                <td width="120">
                    <div class='btn-group'>
                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ri-more-fill align-middle"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <button class="dropdown-item edit-item-btn data-modal" data-url="{{ route('institutions.edit', [$institution->id]) }}">
                                    <i class="ri-pencil-fill align-bottom me-2 text-muted">
                                    </i> Edit
                                </button>
                            </li>
                            <li>
                                {!! Form::open(['route' => ['institutions.destroy', $institution->id], 'method' => 'delete']) !!}
                                {!! Form::button('<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete', ['type' => 'submit', 'class' => 'dropdown-item edit-item-btn', 'data-confirm-delete'=>'true']) !!}
                                {!! Form::close() !!}
                            </li>
                        </ul>

                        <button type="button" class="btn btn-success btn-sm data-modal" data-url="{{ route('institutions.show', [$institution->id]) }}"><i class="ri-eye-fill"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
