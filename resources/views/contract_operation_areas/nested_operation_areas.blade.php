
<ul class="">
    @foreach ($contractOperationAreas as $childOperationArea)
        @if ($childOperationArea->contract_operation_area_id === $parentId)
            <li class="">
                {{ $childOperationArea->area }}
{{--                {{ $childObjective->details }}--}}
                <div class='btn-group'>
                    <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="ri-more-fill align-middle"></i>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <button class="dropdown-item edit-item-btn data-modal" data-url="{{ route('contractOperationAreas.show', [$childOperationArea->id]) }}">
                                <i class="ri-eye-2-fill align-bottom me-2 text-muted">
                                </i> Show
                            </button>
                        </li>
                        <li>
                            <button class="dropdown-item edit-item-btn data-modal" data-url="{{ route('contractOperationAreas.edit', [$childOperationArea->id]) }}">
                                <i class="ri-pencil-fill align-bottom me-2 text-muted">
                                </i> Edit
                            </button>
                        </li>
                        <li>
                            {!! Form::open(['route' => ['contractOperationAreas.destroy', $childOperationArea->id], 'method' => 'delete']) !!}
                            {!! Form::button('<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete', ['type' => 'submit', 'class' => 'dropdown-item edit-item-btn', 'onclick' => "return confirm('Are you sure?')"]) !!}
                            {!! Form::close() !!}
                        </li>
                    </ul>

                </div>
                <hr>
                @include('contract_operation_areas.nested_operation_areas', ['contractOperationAreas' => $contractOperationAreas, 'parentId' => $childOperationArea->id])
            </li>
        @endif
    @endforeach
</ul>
