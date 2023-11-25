@extends('layouts.master')
@section('title', 'Manage Draft Contracts')
@section('content')
    @component('components.breadcrumb')
        @slot('sub_title')
            Draft Agreements
        @endslot
        @slot('action')
            List
        @endslot
    @endcomponent

    <div class="content">
        <div class="card">
            <div class="card-body p-0">
                <style>
                    td.t-1 {
                        white-space: nowrap;
                        overflow: hidden;
                        text-overflow: ellipsis;
                    }
                </style>
                <div class="table-responsive">
                    <table class="table mb-0" id="contracts-table">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Registration No</th>
                            <th>Duration</th>
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
                                <td>{{ $contract->duration }}</td>
                                <td>{{ isset($contract->start_date) ? date('d M, Y', strtotime($contract->start_date)) : 'N/A' }}</td>
                                <td>{{ isset($contract->end_date) ? date('d M, Y', strtotime($contract->end_date)) : 'N/A' }}</td>
                                <td><span class="text-info">
                                @if($contract->status=='Approved')
                                    @else
                                        Pending
                                    @endif
                                </span>
                                </td>

                                <td style="align-items: center; width: 80px;">
                                    <div class="btn-group">
                                        <a class="btn btn-soft-success btn-sm" href="{{ route('draft.contract.show', [encode($contract->id)]) }}"><i class="ri-eye-fill"></i></a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="card-footer clearfix">
                    <div class="float-right">
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection

