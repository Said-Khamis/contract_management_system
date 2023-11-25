
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5>Department Details</h5>
            </div>
        </div>
    </div>
</section>

<div class="content px-3">
    <div class="card">
        <div class="card-body">
            <div class="row">
                <table class="table table-borderless align-middle mb-0">
                    <tbody>
                        @include('departments.show_fields')
                    </tbody>
                </table>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary data-modal" data-url="{{ route('departments.edit', [$department->id]) }}">
                <i class="ri-pencil-fill align-bottom me-2">
                </i>Edit
            </button>
        </div>
    </div>
</div>