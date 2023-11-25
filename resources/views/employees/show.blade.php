
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5>Employee Details</h5>
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
                        @include('employees.show_fields')
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>