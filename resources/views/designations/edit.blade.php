<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h5>Edit Designations</h5>
            </div>
        </div>
    </div>
</section>

<div class="content px-3">
    <div class="card">
        <form id="mForm" accept-charset="UTF-8" enctype="multipart/form-data">
        {!! Form::model($designations, ['route' => ['designations.update', $designations->id], 'method' => 'patch']) !!}

        <div class="card-body">
            <div class="row">
                @include('designations.fields')
            </div>
        </div>

        <div class="card-footer float-end">
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            <a href="{{ route('designations.index') }}" class="btn btn-default">Cancel</a>
        </div>

        {!! Form::close() !!}
        </form>

    </div>
</div>
<script>
    const form = document.getElementById("mForm");
    var errorTitle = document.getElementById("errorTitle");
    form.addEventListener("submit", formSubmit);
    function formSubmit(e) {
        e.preventDefault();
        const formData = new FormData(e.target);
        fetch('{{ route('designations.update', ['designation' => $designations]) }}', {
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
                
            errorTitle.textContent = data.errors.title;
            errorTitle.style.color = "red";
                return false;
            } else {
                this.submit();
            }
        })
        .catch(error => {
            alert('An error occurred while submitting the form.');
            return false;
        });
       // });
    }
            </script>
