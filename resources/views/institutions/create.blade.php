{{--@extends('layouts.master')--}}
{{--@section('title','Add Locations')--}}
{{--@section("content")--}}
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h5>Create Institution</h5>
            </div>
        </div>
    </div>
</section>

<div class="content px-3">
    <div class="card">
        <div class="card-header">
                    <div class="col-sm-12">
                        <span>Create Department</span>
                        <a href="{{route('institutions.index')}}" class="btn btn-outline-secondary btn-sm float-end" >
                            <span class="icon-on"><i class="ri-arrow-left-line align-bottom me-1"></i> Back</span>
                        </a>
                    </div>
                </div>
        <form id="myForm" accept-charset="UTF-8" enctype="multipart/form-data">
        {!! Form::open(['route' => 'institutions.store', 'method' => 'post']) !!}
        <div class="card-body">
            <div class="row">
                @include('institutions.fields')
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

{{--@endsection--}}

{{--@section("script")
    <script type="text/javascript">

        const form = document.getElementById("myForm");
        var errorName = document.getElementById("errorName")
        var errorAbbreviation = document.getElementById("errorAbbreviation")
        form.addEventListener("submit", formSubmit);

        function formSubmit(e) {
            e.preventDefault();
            const formData = new FormData(e.target);
            fetch('{{ route('institutions.store') }}', {
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
                        errorAbbreviation.textContent = data.errors.abbreviation;
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
@endsection--}}

