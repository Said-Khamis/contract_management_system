@extends('layouts.master')

@section('title','Manage Sectors')
@section('content')

    @component('components.breadcrumb')
        @slot('sub_title')
            Sectors
        @endslot
        @slot('action')
            List
        @endslot
    @endcomponent

    @include("sectors._sector_modal")

    <div class="row mb-2">
        <div class="col text-end">
            <a href="javascript:void(0)" class="btn btn-primary data-sector" data-bs-toggle="modal">
                <i class=" bx bx-plus text-green"></i>&ensp; Add Sector
            </a>
            {{--@endif--}}
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card shadow-sm mb-4">
                <div class="card-header py-3">
                    <span style="font-weight: bold; font-size: medium" class="mt-5">Manage Sectors</span>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-sm table-striped table-bordered table-nowrap align-middle mb-0"
                               id="sectors-table"
                               width="100%"
                               cellspacing="0">
                            <thead>
                            <tr>
                                <th width="10">#</th>
                                <th>Name</th>
                                <th>Description</th>
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

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            const table = $('#sectors-table').DataTable({
                searching: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                pageLength: 10,
                ajax: "{{ route('sectors.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'description', name: 'description'},
                    {data: 'actions', name: 'action', orderable: false, searchable: false, sClass: 'text-center'},
                ],
            });

            $(document).on("click", ".sectors-edit", function () {
                const endpoint = $(this).data("endpoint");
                const sectorId = $(this).data("id");

                console.log(endpoint);
                console.log(sectorId);

                $("#formSector").show();
                $("#formShowDetails").hide();

                const actionUrl = "{{ url('sectors/') }}" + sectorId;

                $.ajax({
                    method: "GET",
                    url: endpoint,
                    dataType: "json",
                    success: function (response) {

                        console.log("Response");
                        console.log(response);

                        $("#formSector").attr("action", actionUrl).attr("method", "POST");
                        $("#sectorLabel").empty().html("Edit Sector");
                        $("input[name='name']").val(response.name);
                        $("input[name='sectorId']").val(sectorId);
                        $("input[name='description']").val(response.description);

                        $("#sectorModal").modal("show");
                    },
                    error: function (error) {
                        console.log(error);
                    }

                });
            });

            $(document).on("click", ".sectors-delete", function () {
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
                                method: "GET",
                                url: "{{ url("sector") }}" + "/" + id + "/" + "delete",
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                },
                                success: function (response) {
                                    console.log(response);
                                    Swal.fire(
                                        'Deleted!',
                                        'Sector  has been deleted.',
                                        'success'
                                    );
                                    table.draw();
                                },
                                error: function (error) {
                                    console.log(error);
                                }
                            });

                        }
                    })

            });

            $(document).on("click", ".sectors-show", function () {
                const endpoint = $(this).data("endpoint");

                console.log(endpoint);

                $("#formSector").hide();
                $.ajax({
                    method: "GET",
                    url: endpoint,
                    dataType: "json",
                    success: function (response) {
                        console.log("show");
                        console.log(endpoint);
                        console.log(response.name);


                        $("#formShowDetails").show();

                        console.log(response);
                        $("#sectorLabel").empty().html("Sector Details");
                        var tbody = $("#formShowDetails tbody");
                        $("tr #name").html(response.name);
                        $("tr #desc").html(response.description);
                        $("tr #date_added").html(response.created_at + ", By " + response.created_by_user.email);
                        $("tr #date_modified").html(response.updated_at + ", By " + response.updated_by_user.email);
                        $("#sectorModal").modal("show");

                    },
                    error: function (error) {
                        console.log(error);
                    }

                });
            });


            $('#sectorModal').on('hidden.bs.modal', function () {
                // Destroy the select2 instance if exists
                //$(".select2-class").select2('destroy');
            });

            $(".data-sector").on("click", function () {

                const actionUrl = "{{ route("sectors.store") }}";
                $("#formSector").attr("action", actionUrl);
                $("#formSector").attr("method", "POST");

                $("#sectorModal").modal("show");
                $("#formSector").show();
                $("#formSector")[0].reset();
                $("#formShowDetails").hide();
                //$('.select2-class').val(null).trigger('change');
                $("#sectorLabel").empty().html("Add Sector");
            });

            $.validator.addMethod("hasOnlyCharacters", function (value) {
                return /^[a-zA-Z]+$/.test(value);
            }, "Please enter only characters.");

            $("#formSector").validate({
                rules: {
                    name: {
                        required: true,
                        remote: {
                            url: "{{ url("check/sector") }}",
                            data: {
                                _token: function () {
                                    return "{{ csrf_token() }}";
                                },
                                // id: function () {
                                //     return $("input[name='sectorId']").val()
                                // },
                                name: function () {
                                    return $("#name").val();
                                }
                            },
                            dataFilter: function (data) {
                                try {
                                    return JSON.parse(data).valid;
                                } catch (e) {
                                    return "false";
                                }
                            },
                            type: "POST"
                        }
                    },
                    /*description: {
                        required: true,
                        hasOnlyCharacters: true,
                        remote: {
                            url: "{ { url("check/description") }}",
                            data: {
                                _token: function (){
                                    return "{ { csrf_token() }}";
                                },
                                id: function (){
                                    return $("input[name='sectorId']").val();
                                },
                                description: function (){
                                    return $("#description").val();
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
                    }*/
                },
                messages: {
                    name: {
                        required: "Sector name is required.",
                        remote: "This name is already taken! Try another."
                    },
                    /*description: {
                        required: "Description is required.",
                        remote : "Description is already taken"
                    }*/
                },
                submitHandler: function (form) {
                    form.submit();
                }
            });
        });
    </script>
@endsection
