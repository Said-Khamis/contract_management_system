<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5>User Details</h5>
            </div>
        </div>
    </div>
</section>

<div class="content px-3">
    <div class="card">
        <div class="card-body">
            <div class="row">
                @include('user.show_fields')
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            <a class="btn btn-primary" href="{{ route('user.edit', [encode($user->id)]) }}">
                <i class="ri-pencil-fill align-bottom me-2">
                </i>Edit
            </a>
        </div>
    </div>
</div>
