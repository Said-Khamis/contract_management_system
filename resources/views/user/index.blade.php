@extends('layouts.master')
@section( 'title','Manage Users')
@section('content')
    @component('components.breadcrumb')
        @slot('sub_title')
            Users
        @endslot
        @slot('action')
            List
        @endslot
    @endcomponent
    <div class="row">
        <div class="col">
            <div class="card shadow-sm mb-4">
                <div class="card-header py-3">
                    <span class="mt-5 text-muted">Users List</span>
                    <a href="{{route('user.create')}}" class="btn btn-outline-secondary btn-sm float-end" >
                    <span class="icon-on"><i class="ri-add-line align-bottom me-1"></i> Add User</span>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table class="table table-sm table-striped table-bordered table-nowrap align-middle mb-0" id="users-table" width="100%" cellspacing="0">
                        <thead>
                        <tr>
                            <th width="10">#</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th>Designation</th>
                            <th>Department</th>
                            <th>Institution</th>
                            <th>Status</th>
                            <th>Actions</th>
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

            $(".select2roles").select2({
                placeholder: "Search arole...",
                //dropdownParent: $('#addCampaignLacModal'),
                allowClear: true
            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#users-table').dataTable({
                searching: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                pageLength: 10,
                ajax: "{{ route('user.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'email', name: 'email'},
                    {data: 'role', name: 'role'},
                    {data: 'designation', name: 'designation'},
                    {data: 'department', name: 'department'},
                    {data: 'institution', name: 'institution'},
                    {data: 'status', name: 'status'},
                    {data: 'actions', name: 'action', orderable: false, searchable: false, sClass: 'text-center'},
                ],
            });

        });
    </script>
@endsection

