@extends('layouts.master')

@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            States
        @endslot
        @slot('title')
            Manage State
        @endslot
    @endcomponent
    @include('locations._location_sub_menu')
    <div class="row">
        <div class="col">
            <div class="card shadow-sm mb-4">
                <div class="card-header py-3">
                    <span style="font-weight: bold; font-size: medium" class="mt-5">Manage State</span>
                    <a class="btn btn-outline-secondary btn-sm float-end data-modal" data-url="{{ route('states.create') }}">
                        <span class="icon-on"><i class="ri-add-line align-bottom me-1"></i> Add State</span>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordered table-nowrap align-middle mb-0"
                               id="states-table" width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th width="10">#</th>
                                <th>Name</th>
                                <th>Country</th>
                                <th width="80px">Actions</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
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

            $('#states-table').dataTable({
                searching: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                pageLength: 10,
                ajax: "{{ route('states.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'country', name: 'country'},
                    {data: 'actions', name: 'action', orderable: false, searchable: false, sClass: 'text-center'},
                ],
            });

        });
    </script>
@endsection
