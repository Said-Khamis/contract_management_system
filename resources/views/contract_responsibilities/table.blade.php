<div class="p-2">
    <table style="width: 100%; border-spacing: 0" class="table table-sm table-striped table-nowrap align-middle mb-0" id="contractResponsibilities-table">
        <thead>
        <tr>
            <th>Responsibility Details</th>
            <th class="text-center" width="100">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($contractResponsibilities as $contractResponsibility)
            <tr>
                <td class="text-wrap" style="max-width: 400px;">{{ strlen($contractResponsibility->details) > 100 ? substr($contractResponsibility->details, 0, 100) . '...' : $contractResponsibility->details }}
                </td>
{{--                <td class="text-wrap" style="max-width: 130px;">{{ $contractResponsibility->party->institution->name }}</td>--}}

{{--                <td>--}}
{{--                   @if ($contractResponsibility->start_time)--}}
{{--                       {{ date('d M, Y', strtotime($contract->start_time)) }}--}}
{{--                   @endif--}}
{{--                </td>--}}
{{--                <td>--}}
{{--                    @if ($contractResponsibility->end_time)--}}
{{--                        {{ date('d M, Y', strtotime($contract->end_time)) }}--}}
{{--                    @endif--}}
{{--                </td>--}}
                <td class="text-center" style="align-items: center; width: 120px;">

                    <div class='btn-group'>

                        <button type="button" class="btn btn-soft-secondary btn-sm data-modal"
                                data-url="{{ route('contractResponsibilities.edit', [$contractResponsibility->id]) }}"><i class="ri-edit-fill"></i></button>

                        {!! Form::open(['route' => ['contractResponsibilities.destroy', $contractResponsibility->id], 'method' => 'delete']) !!}
                        {!! Form::button('<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i>', ['type' => 'submit', 'class' => 'btn btn-soft-info btn-sm', 'onclick' => "return confirm('Are you sure?')"]) !!}
                        {!! Form::close() !!}

                        <button type="button" class="btn btn-soft-success btn-sm data-modal"
                                data-url="{{ route('contractResponsibilities.show', [$contractResponsibility->id]) }}"><i
                                class="ri-eye-fill"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
