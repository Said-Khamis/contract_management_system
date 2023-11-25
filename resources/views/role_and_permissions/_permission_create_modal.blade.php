<div class="modal fade" id="permission-create" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="role-permission-update" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="role-permission-update">Create New Permission</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('permission.create')}}" method="post">
                @csrf
                <div class="modal-body">
                    <div class="form-group mb-3">
                        <label for="name" class="mb-0">Permission Name</label>
                        <input id="name" type="text" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="group" class="mb-0">Permission Group</label>
                        <input id="group" type="text" name="group" class="form-control" required>
                    </div>
                </div>
                <div class="modal-footer text-end">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

