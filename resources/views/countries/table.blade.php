<div class="table-responsive">
    <table class="table table-sm table-nowrap mb-0" id="countries-table">
        <thead>
        <tr>
            <th width="30">#</th>
            <th>Name</th>
            <th>Code</th>
            <th colspan="3" style="text-align: center">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($countries as $country)
            <tr>
                <td>{{ $loop->index+1 }}</td>
                <td>
                    <img src="{{ URL::asset('build/images/flags/'.$country->code.'.svg') }}" class="rounded p-0 m-0" alt="Header Language" height="20">
                    {{ ucwords($country->name) }}
                </td>
                <td>{{ strtoupper($country->code) }}</td>
                <td width="80" style="align-items: center">

                    <div class='btn-group'>
                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ri-more-fill align-middle"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <button class="dropdown-item edit-item-btn data-modal" data-url="{{ route('countries.edit', [$country->id]) }}">
                                    <i class="ri-pencil-fill align-bottom me-2 text-muted">
                                    </i> Edit
                                </button>
                            </li>
                            <li>
                                {!! Form::open(['route' => ['countries.destroy', $country->id], 'method' => 'delete']) !!}
                                {!! Form::button('<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete', ['type' => 'submit', 'class' => 'dropdown-item edit-item-btn', 'data-confirm-delete'=>'true']) !!}
                                {!! Form::close() !!}
                            </li>
                        </ul>

                        <button type="button" class="btn btn-success btn-sm data-modal" data-url="{{ route('countries.show', [$country->id]) }}"><i class="ri-eye-fill"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
