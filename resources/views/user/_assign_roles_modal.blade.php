<div class="modal fade" id="role-assign{{encode($user->id)}}" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="role-permission-update" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="role-permission-update">Assign Roles To {{$user->name}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="user/assign/roles" method="post">
                @csrf
                <div class="modal-body" id="">
                    @foreach($roles as $role)
                        <input type="radio" name="role" value="{{encode($role->id)}}" {{$user->hasRole($role->name) != 1 ? '' : 'checked'}}> {{$role->name}}
                    @endforeach
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

