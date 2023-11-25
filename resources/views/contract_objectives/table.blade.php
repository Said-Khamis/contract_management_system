<div class="p-2">
    <table class="table mb-0" id="contractObjectives-table">
        <tbody>
        <ol>
            @foreach ($contractObjectives as $objective)
                @if ($objective->contract_objective_id === null)
                    <li class="mt-1">
                      {{ $objective->details }}
                        <div class='btn-group'>
                            <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="ri-more-fill align-middle"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <button class="dropdown-item edit-item-btn data-modal" data-url="{{ route('contractObjectives.show', [$objective->id]) }}">
                                        <i class="ri-eye-2-fill align-bottom me-2 text-muted">
                                        </i> Show
                                    </button>
                                </li>
                                <li>
                                    <button class="dropdown-item edit-item-btn data-modal" data-url="{{ route('contractObjectives.edit', [$objective->id]) }}">
                                        <i class="ri-pencil-fill align-bottom me-2 text-muted">
                                        </i> Edit
                                    </button>
                                </li>
                                <li>
                                    {!! Form::open(['route' => ['contractObjectives.destroy', $objective->id], 'method' => 'delete']) !!}
                                    {!! Form::button('<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete', ['type' => 'submit', 'class' => 'dropdown-item edit-item-btn', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                    {!! Form::close() !!}
                                </li>
                            </ul>
                            {{--                                                <button type="button" class="btn btn-success btn-sm data-modal" data-url="{{ route('contractObjectives.show', [$childObjective->id]) }}"><i class="ri-eye-fill"></i></button>--}}
                            {{--                                                </a>--}}
                        </div>
                        <hr>
                        @include('contract_objectives.nested_objectives', ['contractObjectives' => $contractObjectives, 'parentId' => $objective->id])

                    </li>
                @endif
            @endforeach
        </ol>
        </tbody>
    </table>
</div>
