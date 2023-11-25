<div class="modal fade" id="role-permission-update{{encode($role->id)}}" data-backdrop="static" data-keyboard="false"
     tabindex="-1" aria-labelledby="role-permission-update" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="role-permission-update">Update Role "{{$role->name}}" Permissions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="/role/assign/permissions" method="post">
                @csrf
                <input type="hidden" name="role" value="{{encode($role->id)}}">
                <div class="modal-body" id="">
                    <div class="row">
                        @foreach($permissions as $group => $group_permissions)
                            <div class="col-md-2 mb-2">
                                <input id="{{$group}}-update" class="form-check-input group-header" type="checkbox" data-permission-group="{{$group}}-checkbox-group-update"  />
                                <label for="{{$group}}-update"><span class="fw-bold"> {{strtoupper($group)}}</span></label><br>
                                @foreach($group_permissions as $permission)
                                    <input type="checkbox" name="permissions[]" class="form-check-input checkbox-group {{$group}}-checkbox-group-update" data-group-header="{{$group}}-update" data-group-permission="{{$group}}-checkbox-group-update"
                                           value="{{$permission->name}}" {{$role->hasPermissionTo($permission->name) != 1 ? '' : 'checked'}}> {{$permission->name}}
                                    <br>
                                @endforeach
                                <hr class="my-3">
                            </div>
                        @endforeach

                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

