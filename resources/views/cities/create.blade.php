    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-12">
                    <h5>Create City</h5>
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        <div class="card">
            <form id="myForm" accept-charset="UTF-8" enctype="multipart/form-data">
            {!! Form::open(['route' => 'cities.store', 'method' => 'post']) !!}

            <div class="card-body">

                <div class="row">
                    @include('cities.fields')
                </div>

            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                {!! Form::submit('Save', ['class' => 'btn btn-primary', 'id' => 'submitBtn']) !!}
            </div>
            {!! Form::close() !!}
        </form>
        </div>
    </div>
    <script>
        const form = document.getElementById("myForm");
        var errorName = document.getElementById("errorName")
        var errorCountry = document.getElementById("errorCountry")
       form.addEventListener("submit", formSubmit);

      function formSubmit(e) {
        e.preventDefault();
        const formData = new FormData(e.target);
        fetch('{{ route('cities.store') }}', {
            method: "POST",
            body: formData,
            headers: {
                "Accept": "application/json",
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
        })
        .then(response => response.json())
        .then(data => {
          //  console.log(data);
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
          //  alert('An error occurred while submitting the form.');
            return false;
        });
       // });
    }
            </script>
