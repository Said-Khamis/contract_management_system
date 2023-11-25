@extends('layouts.master')
@section( 'title','Roles')
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
            Role
        @endslot
        @slot('title')
            Role & Permissions List
        @endslot
    @endcomponent
    <div class="row">
        <div class="col-md-6 col-xs-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    Roles
                    <a href="{{route('role.add')}}" class="btn btn-outline-secondary btn-sm float-end">
                        <span class="icon-on"><i class="ri-add-line align-bottom me-1"></i> Add Role</span>
                    </a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="roles-table" class="table table-sm align-middle mb-0">
                            <thead>
                            <tr>
                                <th style="width: 15px;">#</th>
                                <th>Role</th>
                                <th style="width:80px" class="text-center">Actions</th>
                            </tr>
                            </thead>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-xs-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    Roles Permission
                </div>
                <div class="table-responsive">
                    <table class="table mb-0 align-middle" id="role-permissions-table">
                        <thead>
                            <tr>
                                <th>Role</th>
                                <th>Permissions</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($roles as $role)
                                <tr>
                                    <td style="width: 20%">{{$role->name}}</td>
                                    <td style="width: 70%" class="text-primary">
                                        @foreach($role->permissions as $perm)
                                            {{$perm->name.' | '}}
                                        @endforeach
                                    </td>
                                    <td style="width: 10%">
                                        @if($role->name != 'super-admin' && $role->name != 'admin')
                                        @include('role_and_permissions._role_permission_update_modal')

                                            <a href="javascript:void(0)" title="edit"
                                               data-bs-toggle="modal"
                                               data-role-id="{{encode($role->id)}}"
                                               data-bs-target="#role-permission-update{{encode($role->id)}}">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
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

            $('#roles-table').dataTable({
                searching: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                pageLength: 10,
                ajax: "{{ route('user.role','roles') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'actions', name: 'action', orderable: false, searchable: false, sClass: 'text-center'},
                ],
            });
        });
    </script>
@endsection
