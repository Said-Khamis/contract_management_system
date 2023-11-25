<div class="p-2">
    <table style="width: 100%; border-spacing: 0" class="table table-sm table-striped table-nowrap align-middle mb-0" id="contractOperationAreas-table">
        <thead>
        <tr>
            <th class="text-center">#</th>
            <th>Title</th>
            <th>Date</th>
            <th colspan="" class="">Action</th>
        </tr>
        </thead>
        <tbody>
        @foreach($contractDeliveries as $contractDelivery)
            <tr>
                <td class=""><center>{{ $loop->iteration }}</center></td>
                <td class="">{{ $contractDelivery->title }}</td>
                <td class="">
                    @if($contractDelivery->annual_event==1)
                        {{ $contractDelivery->unit }}   {{ \Carbon\Carbon::parse($contractDelivery->time)->format('jS M') }} each year
                    @elseif($contractDelivery->annual_event==0 && $contractDelivery->unit !=='each')
                        {{ $contractDelivery->unit }}    {{$contractDelivery->time}}
                    @else
                        {{ $contractDelivery->unit }} after  {{ $contractDelivery->duration }} months  from date {{ $contractDelivery->time }}
                    @endif

                </td>

                <td style="align-items: center; width: 120px;">
                    <div class='btn-group'>
                        <button class="btn btn-soft-secondary btn-sm dropdown" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="ri-more-fill align-middle"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <button class="dropdown-item edit-item-btn data-modal" data-url="{{ route('contractDeliveries.edit', [$contractDelivery->id]) }}">
                                    <i class="ri-pencil-fill align-bottom me-2 text-muted">
                                    </i> Edit
                                </button>
                            </li>
                            <li>
                                {!! Form::open(['route' => ['contractDeliveries.destroy', $contractDelivery->id], 'method' => 'delete']) !!}
                                {!! Form::button('<i class="ri-delete-bin-fill align-bottom me-2 text-muted"></i> Delete', ['type' => 'submit', 'class' => 'dropdown-item edit-item-btn', 'onclick' => "return confirm('Are you sure?')"]) !!}
                                {!! Form::close() !!}
                            </li>
                        </ul>
                        <button type="button" class="btn btn-success btn-sm data-modal" data-url="{{ route('contractDeliveries.show', [$contractDelivery->id]) }}"><i class="ri-eye-fill"></i></button>
                    </div>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
