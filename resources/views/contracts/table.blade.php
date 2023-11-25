<div class="table-responsive">
    <table style="width: 100%; border-spacing: 0" class="table table-sm table-striped table-bordered table-nowrap align-middle mb-0" id="contracts-table" >
        <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Title</th>
            <th>Registration No</th>
            <th>Date Signed</th>
            <th>Signed Place</th>
            <th>Ratification Date</th>
            <th>Duration</th>
            <th>Amended</th>
            <th>Start Date</th>
            <th>End Date</th>
            <th>Status</th>
            <th colspan="3">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($contracts as $contract)
            <tr>
                <td width="40" class="text-center">{{ $loop->index+1  }}</td>
                <td class="t-1" style="max-width: 200px">{{ $contract->title }}</td>
                <td>{{ $contract->reference_no }}</td>
                <td>
                    @if ($contract->signed_at)
                        {{ date('d M, Y', strtotime($contract->signed_at)) }}
                    @endif
                </td>
                <td>{{ $contract->signed() ? $contract->getSignedSettlement():'Not signed'}}</td>
                <td>
                    @if ($contract->ratified_at)
                        {{ date('d M, Y', strtotime($contract->ratified_at)) }}
                    @endif
                </td>
                <td>{{ $contract->duration }}</td>
                <td>{{ $contract->is_amended ? 'Yes' : 'No' }}</td>
                <td>
                    {{ isset($contract->start_date) ? date('d M, Y', strtotime($contract->start_date)) : 'N/A' }}
                </td>
                <td>{{ isset($contract->end_date) ? date('d M, Y', strtotime($contract->end_date)) : 'N/A' }}</td>
                <td>
                    @if($contract->signed_at)
                        <span class="badge rounded-pill text-bg-success"> Complete </span>
                    @else
                        <span class="badge rounded-pill text-bg-warning">Pending</span>
                    @endif

                  </td>

                <td style="align-items: center; width: 80px;">
                    <div class="btn-group">
                        <a class="btn btn-soft-success btn-sm" href="{{ route('contractss.show', [encode($contract->id)]) }}"><i class="ri-eye-fill"></i></a>

{{--                        @if(!getContractOperationAreas($contract->id)->isEmpty())--}}
{{--                        @if(!getContractSector($contract->id)->isEmpty())--}}
{{--                            <button type="button" class="btn btn-soft-success btn-sm data-modal"--}}
{{--                                    data-url="{{ url('contractSendTo', [$contract->id]) }}"><i--}}
{{--                                    class="bx bx-arrow-from-left"></i></button>--}}
{{--                        @endif--}}
{{--                        @endif--}}
                        <a type="button" class="btn btn-soft-secondary btn-sm"  href="{{ route('contractss.edit', [encode($contract->id)]) }}"><i class="ri-pencil-fill"></i></a>
                        @can('delete contractss')
                            <form action="{{route('contractss.delete',encode($contract->id))}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-soft-danger btn-sm" ><i class="ri-delete-bin-fill"></i></button>
                            </form>
                        @endcan
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
