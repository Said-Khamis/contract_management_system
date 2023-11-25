<!-- staticBackdrop Modal -->
<div class="modal fade" id="countryCreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="margin-left: 1.8em;" id="role-permission-update">Add new country</h5>
                <button type="button" class="btn-close fw-medium" data-bs-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <form action="{{route('countries.store')}}" method="post" id="mForm">
                @csrf
                <div class="modal-body text-center p-5">
                    <div class="row">
                        @include('countries.fields')
                    </div>

                    <div class="mt-4">
                        <div class="hstack gap-2 justify-content-end">
                            <a href="javascript:void(0);" class="btn btn-light fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
                            <button id="saveCountry" href="" class="saveCountry btn btn-primary"><i class="ri-save-2-fill me-1 align-middle"></i> Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
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
            // Check if there is an error in the response
            if (data.errors) {
            errorName.textContent = data.errors.name;
            errorCode.textContent = data.errors.code;
            errorName.style.color = "red";
            errorCode.style.color = "red";
                return false;
            } else {
                this.submit();
                $('#countries-table').DataTable().ajax.reload();
            }
        })
        .catch(error => {
          //  alert('An error occurred while submitting the form.');
            return false;
        });
       // });
    }
</script>
