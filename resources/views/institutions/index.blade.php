@extends('layouts.master')

@section('title','Manage Institutions')
@section('content')

    @component('components.breadcrumb')
        @slot('sub_title')
            Institutions
        @endslot
        @slot('action')
            List
        @endslot
    @endcomponent

    @include("institutions._institution_modal")

    <div class="row mb-2">
        <div class="col text-end">
            {{--@if(Request::is('departments'))--}}
            {{-- <a href="javascript:void(0)" class="btn btn-primary data-modal" data-bs-toggle="modal" data-url="{{ route('departments.create') }}">
                 <i class=" bx bx-plus text-green"></i>&ensp; Add Department
             </a>--}}
            <a href="javascript:void(0)" class="btn btn-primary data-institution" data-bs-toggle="modal">
                <i class=" bx bx-plus text-green"></i>&ensp; Add Institution
            </a>
            {{--@endif--}}
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card shadow-sm mb-4">
                <div class="card-header py-3">
                    <span style="font-weight: bold; font-size: medium" class="mt-5">Manage Institutions</span>
                   {{-- <a class="btn btn-outline-secondary btn-sm float-end data-modal" data-url="{{ route('institutions.create') }}">
                        <span class="icon-on"><i class="ri-add-line align-bottom me-1"></i> Add Institution</span>
                    </a>--}}
                    {{-- <a class="btn btn-outline-secondary btn-sm float-end"  href="{{ route('institutions.create') }}" >
                        <span class="icon-on"><i class="ri-add-line align-bottom me-1"></i> Add Institution</span>
                    </a>--}}
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordered table-nowrap align-middle mb-0"
                               id="institutions-table"
                               width="100%"
                               cellspacing="0">
                            <thead>
                            <tr>
                                <th width="10">#</th>
                                <th>Name</th>
                                <th>Abbreviation</th>
                                <th width="80px">Actions</th>
                            </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script type="text/javascript">
        $(function () {
            $(".institution-select2").select2();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            const table = $('#institutions-table').DataTable({
                searching: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                pageLength: 10,
                ajax: "{{ route('institutions.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'abbreviation', name: 'abbreviation'},
                    {data: 'actions', name: 'action', orderable: false, searchable: false, sClass: 'text-center'},
                ],
            });

            $(document).on("click", ".institution-edit", function () {
                const endpoint = $(this).data("endpoint");
                const institutionId = $(this).data("id");

                console.log(endpoint);
                console.log(institutionId);

                $("#formInstitution").show();
                $("#formShowDetails").hide();

                const actionUrl = "{{ url('institution/update/') }}";

                $.ajax({
                    method : "GET",
                    url: endpoint,
                    dataType : "json",
                    success : function (response) {

                        console.log("Response");
                        console.log(response);

                        $("#formInstitution").attr("action", actionUrl).attr("method", "POST");
                        $("#instLabel").empty().html("Edit Institution");
                        $("input[name='name']").val(response.name);
                        $("input[name='institutionId']").val(institutionId);
                        $("input[name='abbreviation']").val(response.abbreviation);

                        $("input[name='is_local']").prop('checked', response.is_local);
                        $("input[name='is_sector']").prop('checked', response.is_sector);

                        const select2Institution = $(".institution-select2-2");
                        if(response.parent !== null){
                            select2Institution.append(new Option(response.parent.name, response.parent.id, true, true));
                        }
                        else {
                            select2Institution.val(null);
                        }
                        select2Institution.trigger("change");

                        $("#institutionModal").modal("show");
                    },
                    error : function (error) {
                        console.log(error);
                    }

                });
            });

            $(document).on("click", ".institution-delete", function () {
                const id = $(this).data("id");

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                })
                    .then((result) => {
                        if (result.isConfirmed) {

                            $.ajax({
                                method : "GET",
                                url: "{{ url("institution") }}"+"/"+id+"/"+"delete",
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                },
                                success : function (response) {
                                    console.log(response);
                                    Swal.fire(
                                        'Deleted!',
                                        'Institution  has been deleted.',
                                        'success'
                                    );
                                    table.draw();
                                },
                                error : function (error) {
                                    console.log(error);
                                }
                            });

                        }
                    })

            });

            $(document).on("click", ".institution-show", function () {
                const endpoint = $(this).data("endpoint");

                console.log(endpoint);

                $("#formInstitution").hide();
                $.ajax({
                    method : "GET",
                    url: endpoint,
                    dataType : "json",
                    success : function (response) {
                        console.log("show");
                        console.log(endpoint);
                        console.log(response.name);


                        $("#formShowDetails").show();

                        console.log(response);
                        $("#instLabel").empty().html("Institution Details");
                        var tbody = $("#formShowDetails tbody");
                        $("tr #name").html(response.name);
                        $("tr #desc").html(response.abbreviation);
                        if (response.parent !== null){
                            $("tr #institution").html(response.parent.name);
                        }
                        else{
                            $("tr #institution").html("N/A");
                        }
                        $("tr #date_added").html(response.created_at + ", By " + response.created_by_user.email);
                        $("tr #date_modified").html(response.updated_at + ", By " + response.updated_by_user.email);
                        $("#institutionModal").modal("show");

                    },
                    error : function (error) {
                        console.log(error);
                    }

                });
            });


            $(".institution-select2-2").select2({
                placeholder: "Search Institution...",
                dropdownParent: $('#institutionModal'),
                allowClear: true
            });

            $('#institutionModal').on('hidden.bs.modal', function () {
                // Destroy the select2 instance
                $(".institution-select2").select2('destroy');
            });

            $(".data-institution").on("click", function () {

                //const formInstitution = $("#formInstitution");
                const actionUrl = "{{ route("institutions.store") }}";
                $("#formInstitution").attr("action", actionUrl);
                $("#formInstitution").attr("method", "POST");

                $("#institutionModal").modal("show");
                $("#formInstitution").show();
                $("#formInstitution")[0].reset();
                $("#formShowDetails").hide();
                $('.institution-select2-2').val(null).trigger('change');
                $("#instLabel").empty().html("Add Institution");
            });

            $.validator.addMethod("hasOnlyCharacters", function(value) {
                return /^[a-zA-Z]+$/.test(value);
            }, "Please enter only characters.");

            $("#formInstitution").validate({
                rules: {
                    name: {
                        required: true,
                        remote: {
                            url: "{{ url("check/institution") }}",
                            data: {
                                _token: function (){
                                   return "{{ csrf_token() }}";
                                },
                                id: function (){
                                   return $("input[name='institutionId']").val()
                                },
                                name: function (){
                                    return $("#name").val();
                                }
                            },
                            dataFilter: function(data){
                                try {
                                    return JSON.parse( data ).valid;
                                } catch (e) {
                                    return "false";
                                }
                            },
                            type: "POST"
                        }
                    },
                    abbreviation: {
                        required: true,
                        hasOnlyCharacters: true,
                        remote: {
                            url: "{{ url("check/abbreviation") }}",
                            data: {
                                _token: function (){
                                    return "{{ csrf_token() }}";
                                },
                                id: function (){
                                    return $("input[name='institutionId']").val();
                                },
                                abbreviation: function (){
                                    return $("#abbreviation").val();
                                }
                            },
                            dataFilter: function(data){
                                try {
                                    return JSON.parse( data ).valid;
                                } catch (e) {
                                    return "false";
                                }
                            },
                            type: "POST"
                        }
                    }
                },
                messages: {
                    name: {
                        required: "Institution name is required.",
                        remote: "This name is already taken! Try another."
                    },
                    abbreviation: {
                        required: "Abbreviation is required.",
                        remote : "Abbreviation is already taken"
                    }
                },
                submitHandler: function(form) {
                    //form.preventDefault();
                    form.submit();
                }
            });

            /*$("#formInstitution").on("submit", function (e) {
                e.preventDefault(); // Prevent the default form submission

                const form = $(this);
                const actionUrl = form.attr("action");
                const formData = form.serialize();
                console.log("Form Data");
                console.log(formData);

                $.ajax({
                    url: actionUrl,
                    type: "POST",
                    data: formData,
                    dataType: "json",
                    success: function (response) {
                        console.log("Response");
                        console.log(response);

                        // Check if the submission was successful
                        if (response.success) {
                            // Close the modal on success
                            $("#institutionModal").modal("hide");
                            // You can also perform additional actions here if needed
                        } else {
                            console.log(response.errors);
                            // Display validation errors to the user
                            // Assuming you have an element with the ID 'error-messages' to display errors
                            $("#error-messages").html(response.errors);
                        }
                    },
                    error: function (error) {
                        console.log("Response Error");
                        console.log(error.responseJSON.errors.abbreviation[0]);
                        const errors = error.responseJSON.errors;

                        $('#validation-errors').html('');
                        $.each(errors, function(key, value) {
                            if (value === "abbreviation"){
                               console.log("Abbre");
                            }
                            $('#validation-errors').append('<div class="alert alert-danger">' + value + '</div>');
                        });
                        // Handle other types of errors if necessary
                    }
                });
            });*/

        });
    </script>
@endsection
