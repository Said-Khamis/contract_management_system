


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Edit District</h4>
                </div><!-- end card header -->
                <form id="myForm" accept-charset="UTF-8" enctype="multipart/form-data">
                {!! Form::model($district, ['route' => ['districts.update', $district->id], 'method' => 'post']) !!}
                    @method('PATCH')
                <div class="card-body">
                    <div class="row">
                        @include('districts.fields')
                    </div>
                </div><!-- end card-body -->

                <div class="modal-footer">
                    <a href="{{ route('districts.index') }}" class="btn btn-default">Cancel</a>
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                </div>

                {!! Form::close() !!}
                </form>
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
    <script>
        const form = document.getElementById("myForm");
        var errorName = document.getElementById("errorName")
        var errorRegion = document.getElementById("errorRegion")
       form.addEventListener("submit", formSubmit);

      function formSubmit(e) {
        e.preventDefault();
        const formData = new FormData(e.target);
        fetch('{{ route('districts.update', ['district' => $district]) }}', {
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
                errorRegion.textContent = data.errors.region_id;
                errorName.style.color = "red";
                errorRegion.style.color = "red";
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


