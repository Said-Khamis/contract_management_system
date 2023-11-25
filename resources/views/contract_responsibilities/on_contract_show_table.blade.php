<div class="table-responsive p-2">
    <table style="width: 100%; border-spacing: 0" class="table table-sm table-striped table-nowrap align-middle mb-0" id="contractResponsibilities-table">
        <thead>
        <tr>
            <th>Responsibility Details</th>
            <th class="text-center" colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($contractResponsibilities as $contractResponsibility)
            <tr>
                <td class="t-1" style="max-width: 70px;">{{ $contractResponsibility->details }}</td>
{{--                <td class="t-1" style="max-width: 70px;">{{ $contractResponsibility->party->institution->name }}</td>--}}
{{--                <td>--}}
{{--                    @if ($contractResponsibility->start_time)--}}
{{--                        {{ date('d M, Y', strtotime($contractResponsibility->start_time)) }}--}}
{{--                    @endif--}}
{{--                </td>--}}
{{--                <td>--}}
{{--                    @if ($contractResponsibility->end_time)--}}
{{--                        {{ date('d M, Y', strtotime($contractResponsibility->end_time)) }}--}}
{{--                    @endif--}}
{{--                </td>--}}
                <td class="text-center" style="align-items: center; width: 120px;">
                    <div class='btn-group'>
                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ri-more-fill align-middle"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <button class="dropdown-item edit-item-btn data-modal" data-url="{{ route('contractResponsibilities.edit', [$contractResponsibility->id]) }}">
                                    <i class="ri-pencil-fill align-bottom me-2 text-muted">
                                    </i> Edit
                                </button>
                            </li>
                            <li>
                                {!! Form::open(['route' => ['contractResponsibilities.destroy', $contractResponsibility->id], 'method' => 'delete']) !!}
                                    {!! Form::button('<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete', ['type' => 'submit', 'class' => 'dropdown-item edit-item-btn', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                {!! Form::close() !!}
                            </li>
                        </ul>
                        <button type="button" class="btn btn-success btn-sm data-modal" data-url="{{ route('contractResponsibilities.show', [$contractResponsibility->id]) }}"><i class="ri-eye-fill"></i></button>
                        </a>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
