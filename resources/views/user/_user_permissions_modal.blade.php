<div class="modal fade" id="user-permissions{{encode($user->id)}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="role-permission-update" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="role-permission-update">{{$user->name}} Permissions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="user/assign/permissions" method="post">
                @csrf
                <div class="modal-body" id="">
                    <div class="row text-start">
                        @foreach($user->roles as $role)
                            @foreach($role->permissions->chunk(5) as $index => $chunk)
                                <div class="col-md-2">
                                    @foreach($chunk as $perm)
                                        <input type="checkbox" name="permissions[]" value="{{$perm->name}}" {{$user->hasPermissionTo($perm->name) != 1 ? '' : 'checked'}}> {{$perm->name}}<br>
                                    @endforeach
                                    <hr class="my-3">
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                    <input type="hidden" name="userId" value="{{encode($user->id)}}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

