<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h5>Edit City</h5>
            </div>
        </div>
    </div>
</section>

<div class="content px-3">
    <div class="card">
        <form id="mForm" accept-charset="UTF-8" enctype="multipart/form-data">
        {!! Form::model($country, ['route' => ['cities.update', $country->id], 'method' => 'post']) !!}
        @method('PATCH')
        <div class="card-body">
            <div class="row">
                @include('countries.fields',['country'=>$country??''])
            </div>
        </div>

        <div class="modal-footer">
            <a href="{{ route('countries.index') }}" class="btn btn-default">Cancel</a>
            {!! Form::submit('Save', ['class' => 'btn btn-primary', 'id' => 'submitBtn']) !!}
        </div>

        {!! Form::close() !!}
        </form>
    </div>
</div>
<script>
const form = document.getElementById("mForm");
var errorName = document.getElementById("errorName");
var errorCode = document.getElementById("errorCode");
form.addEventListener("submit", formSubmit);
function formSubmit(e) {
    e.preventDefault();
    const formData = new FormData(e.target);
    fetch('{{ route('countries.update', ['country' => $country]) }}', {
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
        errorCode.textContent = data.errors.code;
        errorName.style.color = "red";
        errorCode.style.color = "red";
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
