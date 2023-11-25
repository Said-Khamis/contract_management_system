@if($errors->any())
    <div class="form-group col-md-12 mb-1">

        <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
            <strong> Something wrong! </strong><br>
            @foreach($errors->all() as $error)
                <a href="#" class="alert-link"></a> {{ $error }}
                <br>
            @endforeach
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    </div>
@endif
