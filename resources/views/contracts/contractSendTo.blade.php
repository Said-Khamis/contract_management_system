<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h5>Send Agreement Form</h5>
            </div>
        </div>
    </div>
</section>

<div class="content px-3">
    <div class="card">
        <form method="POST" action="{{ route('submitSendContractTo') }}">
            @csrf
        <div class="card-body">

            <div class="row">
                @include('contracts.send_fields')
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
        </form>

    </div>
</div>
