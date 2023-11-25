@extends('layouts.master')
@section( 'title','Permissions')
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Permissions
        @endslot
        @slot('title')
            Permissions List
        @endslot
    @endcomponent
    @include('role_and_permissions._permission_create_modal')
    <div class="row mt-4">
        <div class="col">
            <div class="card shadow mb-4">
                <div class="card-header">
                    <span style="font-weight: bold; font-size: medium" class="mt-5">Permissions</span>
                    <button type="button" class="btn btn-outline-secondary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#permission-create">
                        <span class="icon-on"><i class="ri-add-line align-bottom me-1"></i> Add Permission</span>
                    </button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="permissions-table" class="table table-striped table-sm align-middle mb-0">
                            <thead>
                            <tr>
                                <th style="width: 30px;">#</th>
                                <th>Name</th>
                                <th>Group</th>
{{--                                <th style="width: 80px">Actions</th>--}}
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

            $('#permissions-table').dataTable({
                searching: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                pageLength: 10,
                ajax: "{{ route('user.role','permissions') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'group', name: 'group'},
                    // {data: 'actions', name: 'action', orderable: false, searchable: false, sClass: 'text-center'},
                ],
            });

        });
    </script>
@endsection
