<div class="table-responsive p-3">
    <table style="width: 100%; border-spacing: 0" class="table table-sm table-striped table-bordered my-0">
        <tr>
            <th>
                Title
            </th>
            <td colspan="3">
                {{ $contract->title }}
            </td>
        </tr>
        <tr>
            <th>
                Start Date
            </th>
            <td>
                @if ($contract->start_date)
                    {{ date('d M, Y', strtotime($contract->start_date)) }}
                @endif
            </td>
            <th>
                End Date
            </th>
            <td>
                @if ($contract->end_date)
                    {{ date('d M, Y', strtotime($contract->end_date)) }}
                @endif
            </td>
        </tr>
        <tr>
            <th>
                Registration No
            </th>
            <td>
                {{ $contract->reference_no }}
            </td>
            <th>
                Duration (In Years)
            </th>
            <td>
                {{ $contract->duration }}
            </td>
        </tr>
        @if($contract->signed())
            <tr>
                <th>
                    Signed Date
                </th>
                <td>
                    {{ date('d M, Y', strtotime($contract->signed_at)) }}
                </td>
                <th>
                    Signed Place
                </th>
                <td>
                    {{ getSignedSettlement($contract->id)}}
                </td>
            </tr>
        @endif
        @if($contract->ratified())
            <tr>
                <th>
                    Ratified
                </th>
                <td>
                    {{ $contract->ratified() ? 'Yes' : 'No'}}
                </td>
                <th>
                    Ratified Date
                </th>
                <td>
                    {{ date('d M, Y', strtotime($contract->ratified_at)) }}
                </td>
            </tr>
        @endif
        <tr>
            <th>
                Type
            </th>
            <td>
                {{ $contract->type}}
            </td>
            <th>
                Amended
            </th>
            <td>
                {{ $contract->amended ? 'Yes':'No'}}
            </td>
        </tr>
        <tr>
            <th>
                Time Created
            </th>
            <td>
                {{ date('d M, Y H:i', strtotime($contract->created_at)) }}
            </td>
            <th>
                Created By
            </th>
            <td>
               <b> {{ \App\Models\User::find($contract->created_by)->first_name }} </b>
                <i style="color: grey;">{{ \App\Models\User::find($contract->created_by)->email }}</i>
            </td>
        </tr>

        <tr>
            <th>
                Time Updated
            </th>
            <td>
                {{ date('d M, Y H:i', strtotime($contract->created_at)) }}
            </td>
            <th>
                Updated By
            </th>
            <td>
                {{
                 $contract->isUpdated()
                 ? \App\Models\User::find($contract->updated_by)->first_name . '('. \App\Models\User::find($contract->updated_by)->email .')'
                 : 'Not Updated'
                }}
            </td>
        </tr>
        <tr>
            <th>
                Status
            </th>
            <td>
                @if($contract->signed_at)
                    <span class="badge rounded-pill text-bg-success"> Signed </span>
                @else
                    <span class="badge rounded-pill text-bg-warning"> Draft </span>
                @endif
            </td>
            <th>
                Office At :
            </th>
            <td>
                {{ $contract->currentOffice() }}
            </td>
        </tr>

    </table>
</div>


