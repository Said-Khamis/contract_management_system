@extends('layouts.master')
@section('title', 'Agreements Management')
@section('content')
    @component('components.breadcrumb')
        @slot('sub_title')
            Agreements
        @endslot
        @slot('action')
            List
        @endslot
    @endcomponent

{{--    @include('contractss._contract_sub_menu')--}}

    <div class="content">

        <div class="card shadow-sm mb-4">
            <div class="card-header py-3">
                <span style="font-size: 1.3em" class="badge rounded-pill badge-soft-secondary">Contracts Lists</span>
                <a href="{{route('contractss.create.form')}}" class="btn btn-outline-secondary btn-sm float-end" >
                    <span class="icon-on"><i class="ri-add-line align-bottom me-1"></i> Register Agreement</span>
                </a>
            </div>
            <div class="card-body p-3">
                <div class="table-responsive">
                    <table style="width: 100%; border-spacing: 0;margin: 0;padding: 0" class="table table-sm table-striped table-bordered table-nowrap align-middle mb-0" id="contracts-table" >
                        <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Title</th>
                            <th>Registration No</th>
                            <th>Date Signed</th>
                            <th>Signed Place</th>
                            <th>Ratification Date</th>
                            <th>Duration</th>
{{--                            <th>Amended</th>--}}
                            <th>Start Date</th>
                            <th>End Date</th>
                            <th>Status</th>
                            <th colspan="3">Action</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#contractss-table').DataTable({
                searching: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                pageLength: 20,
                ajax: "{{ route('contractss.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'title', name: 'title'},
                    {data: 'register_no', name: 'register_no'},
                    {data: 'date_signed', name: 'date_signed'},
                    {data: 'signing_place', name: 'signing_place'},
                    {data: 'ratification_date', name: 'ratification_date'},
                    {data: 'duration', name: 'duration'},
                    // {data: 'amendment', name: 'amendment'},
                    {data: 'start_date', name: 'start_date'},
                    {data: 'end_date', name: 'end_date'},
                    {data: 'status', name: 'status'},
                    {data: 'action', name: 'action', orderable: false, serachable: false, sClass: 'text-center'},
                ],
            });

        });
    </script>
@endsection
