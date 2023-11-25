<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h5>Create Country</h5>
            </div>
        </div>
    </div>
</section>

<div class="content px-3">

    <div class="card">
        <form id="myForm" accept-charset="UTF-8" enctype="multipart/form-data">
        {!! Form::open(['route' => 'countries.store', 'method' => 'post']) !!}

        <div class="card-body">

            <div class="row">
                @include('countries.fields',['country'=>null])
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
    var errorCode = document.getElementById("errorCode")
    var errorFlexRadioDefault = document.getElementById("errorFlexRadioDefault")
   form.addEventListener("submit", formSubmit);

  function formSubmit(e) {
    e.preventDefault();
    const formData = new FormData(e.target);
    fetch('{{ route('countries.store') }}', {
        method: "POST",
        body: formData,
        headers: {
            "Accept": "application/json",
            'X-CSRF-TOKEN': '{{ csrf_token() }}'
        },
    })
    .then(response => response.json())
    .then(data => {
       console.log(data);
        // Check if there is an error in the response
        if (data.errors) {
            errorName.textContent = data.errors.name;
            errorCode.textContent = data.errors.code;
            errorFlexRadioDefault.textContent = data.errors.flexRadioDefault;
            errorName.style.color = "red";
            errorCode.style.color = "red";
            errorFlexRadioDefault.style.color = "red";
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
