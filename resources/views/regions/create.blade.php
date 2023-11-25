

    <div class="content px-3">

        <div class="card">
            <form id="mForm" accept-charset="UTF-8" enctype="multipart/form-data">
            {!! Form::open(['route' => 'regions.store']) !!}

            <div class="card-body">

                <div class="row">
                    @include('regions.fields')
                </div>

            </div>

            <div class="modal-footer">
                <a href="{{ route('regions.index') }}" class="btn btn-default">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
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
            fetch('{{ route('regions.store') }}', {
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
                alert('An error occurred while submitting the form.');
                return false;
            });
           // });
        }
                </script>