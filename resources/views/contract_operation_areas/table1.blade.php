<div class="">
    <table class="table mb-0" id="contractOperationAreas-table">
        <thead>
        <tr>
            <th>Area</th>
            <th>Details</th>
            <th width="100">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($contractOperationAreas as $contractOperationArea)
            @if($contractOperationArea->contract_operation_area_id == null)
                <tr>
                    <td>{{ $contractOperationArea->area }}</td>
                    <td>{{ $contractOperationArea->details }}</td>
                    <td style="align-items: center; width: 120px;">
                        <div class='btn-group'>
                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-more-fill align-middle"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <button class="dropdown-item edit-item-btn data-modal" data-url="{{ route('contractOperationAreas.edit', [$contractOperationArea->id]) }}">
                                        <i class="ri-pencil-fill align-bottom me-2 text-muted">
                                        </i> Edit
                                    </button>
                                </li>
                                <li>
                                    {!! Form::open(['route' => ['contractOperationAreas.destroy', $contractOperationArea->id], 'method' => 'delete']) !!}
                                    {!! Form::button('<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete', ['type' => 'submit', 'class' => 'dropdown-item edit-item-btn', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                    {!! Form::close() !!}
                                </li>
                            </ul>
                            <button type="button" class="btn btn-success btn-sm data-modal" data-url="{{ route('contractOperationAreas.show', [$contractOperationArea->id]) }}"><i class="ri-eye-fill"></i></button>
                            </a>
                        </div>
                    </td>
                </tr>
            @endif
            @if(count($contractOperationArea->contractOperationAreas) > 0)
                @foreach($contractOperationArea->contractOperationAreas as $inContractOperationArea)
                    <tr>
                        <td> - {{ $contractOperationArea->area }}</td>
                        <td> - {{ $contractOperationArea->details }}</td>
                        <td style="align-items: center; width: 120px;">
                            <div class='btn-group'>
                                <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ri-more-fill align-middle"></i>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li>
                                        <button class="dropdown-item edit-item-btn data-modal" data-url="{{ route('contractOperationAreas.edit', [$inContractOperationArea->id]) }}">
                                            <i class="ri-pencil-fill align-bottom me-2 text-muted">
                                            </i> Edit
                                        </button>
                                    </li>
                                    <li>
                                        {!! Form::open(['route' => ['contractOperationAreas.destroy', $inContractOperationArea->id], 'method' => 'delete']) !!}
                                        {!! Form::button('<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete', ['type' => 'submit', 'class' => 'dropdown-item edit-item-btn', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                        {!! Form::close() !!}
                                    </li>
                                </ul>
                                <button type="button" class="btn btn-success btn-sm data-modal" data-url="{{ route('contractOperationAreas.show', [$inContractOperationArea->id]) }}"><i class="ri-eye-fill"></i></button>
                                </a>
                            </div>
                        </td>
                    </tr>
                @endforeach
            @endif
        @endforeach
        </tbody>
    </table>
</div>
