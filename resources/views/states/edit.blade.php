<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h5>Edit States</h5>
            </div>
        </div>
    </div>
</section>

<div class="content px-3">
    <div class="card">
        <form id="mForm" accept-charset="UTF-8" enctype="multipart/form-data">
        {!! Form::model($states, ['route' => ['states.update', $states->id], 'method' => 'post']) !!}
        @method('PATCH')
        <div class="card-body">
            <div class="row">
                @include('states.fields')
            </div>
        </div>

        <div class="card-footer float-end">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            <a href="{{ route('states.index') }}" class="btn btn-default">Cancel</a>
        </div>

        {!! Form::close() !!}
        </form>

    </div>
</div>
<script>
    const form = document.getElementById("mForm");
    var errorName = document.getElementById("errorName");
    var errorCountry = document.getElementById("errorCountry");
    form.addEventListener("submit", formSubmit);
    function formSubmit(e) {
        e.preventDefault();
        const formData = new FormData(e.target);
        fetch('{{ route('states.update', ['state' => $states])}}', {
            method: "POST",
            body: formData,
            headers: {
                "Accept": "application/json",
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        })
        .then(response => response.json())
        .then(data => {
            // Check if there is an error in the response
            if (data.errors) {
                
            errorName.textContent = data.errors.name;
            errorCountry.textContent = data.errors.country_id;
            errorName.style.color = "red";
            errorCountry.style.color = "red";
                return false;
            } else {
                this.submit();
            }
        })
        .catch(error => {
            alert(error);
           // alert('An error occurred while submitting the form.');
            return false;
        });
       // });
    }
            </script>

