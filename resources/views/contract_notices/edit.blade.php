<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h5>Edit Notice</h5>
            </div>
        </div>
    </div>
</section>

<div class="content px-3">
    <div class="card">

        {!! Form::model($contractNotice, ['route' => ['contractNotices.update', $contractNotice->id], 'method' => 'patch','files' => true, 'enctype' => 'multipart/form-data']) !!}

        <div class="card-body">
            <div class="row">
                @include('contract_notices.fields')
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>
</div>
