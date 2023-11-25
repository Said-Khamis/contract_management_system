<div class="p-2">
    <table style="width: 100%; border-spacing: 0" class="table table-sm table-striped table-nowrap align-middle mb-0" id="contractSectors-table">
        <thead>
        <tr>
            <th>Responsible Sector</th>
            <th>Contract Owner</th>
            <th>Implementer</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($contractSectors as $contractSector)
            <tr>
                <td class="t-1" style="max-width: 300px;">{{ $contractSector->institute->name }}</td>
                <td>{{ ($contractSector->is_owner) ? 'Yes': 'No' }} </td>
                <td>{{ ($contractSector->is_current_implementer) ? 'Yes ': 'No' }}</td>
                <td style="align-items: center; width: 120px;">
                    <div class='btn-group'>
                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ri-more-fill align-middle"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <button class="dropdown-item edit-item-btn data-modal" data-url="{{ route('contractSectors.edit', [$contractSector->id]) }}">
                                    <i class="ri-pencil-fill align-bottom me-2 text-muted">
                                    </i> Edit
                                </button>
                            </li>
                            <li>
                                {!! Form::open(['route' => ['contractSectors.destroy', encode($contractSector->id)], 'method' => 'delete']) !!}
                                    {!! Form::button('<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete', ['type' => 'submit', 'class' => 'dropdown-item edit-item-btn', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                {!! Form::close() !!}
                            </li>
                        </ul>
                        <button type="button" class="btn btn-success btn-sm data-modal" data-url="{{ route('contractSectors.show', [$contractSector->id]) }}"><i class="ri-eye-fill"></i></button>
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
