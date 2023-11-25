<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h5>Edit Area of Cooperation</h5>
            </div>
        </div>
    </div>
</section>

<div class="content px-3">
    <div class="card">

        {!! Form::model($contractOperationArea, ['route' => ['contractOperationAreas.update', $contractOperationArea->id], 'method' => 'patch']) !!}

        <div class="card-body">
            <div class="row">
                @include('contract_operation_areas.fields')
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>
</div>
