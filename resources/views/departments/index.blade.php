@extends('layouts.master')

@section("content")
    {{--@section('title', 'Manage Departments')--}}
    @component('components.breadcrumb')
        @slot('sub_title')
            Departments
        @endslot
        @slot('action')
            List
        @endslot
    @endcomponent

    @include("departments._depart_modal")

    <div class="row mb-2">
        <div class="col text-end">
            {{--@if(Request::is('departments'))--}}
               {{-- <a href="javascript:void(0)" class="btn btn-primary data-modal" data-bs-toggle="modal" data-url="{{ route('departments.create') }}">
                    <i class=" bx bx-plus text-green"></i>&ensp; Add Department
                </a>--}}
            <a href="javascript:void(0)" class="btn btn-primary data-depart" data-bs-toggle="modal">
                <i class=" bx bx-plus text-green"></i>&ensp; Add Department
            </a>
            {{--@endif--}}
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h1 class="card-title">List of Departments</h1>
                   {{-- <a href="{{route('departments.create')}}" class="btn btn-outline-secondary btn-sm float-end" >
                        <span class="icon-on"><i class="ri-add-line align-bottom me-1"></i> Add Department</span>
                    </a>--}}
                </div>

                <div id="table-fixed-header">
                    <div class="table-responsive p-3">
                        <table class="table table-sm table-striped table-bordered table-nowrap align-middle mb-0" id="departments-table"width="100%" cellspacing="0">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Institution</th>
                                <th>Description</th>
                                <th colspan="3">Action</th>
                            </tr>
                            </thead>
                            {{--JQUERY DATATABLE --}}

                        </table>
                    </div>
                </div>
               {{-- <div class="card-footer">
                    {{$departments->links()}}
                </div>--}}
            </div>
        </div>
    </div>

@endsection

@section('script')
    <script type="text/javascript">
        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            var table = $('#departments-table').DataTable({
                searching: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                pageLength: 10,
                ajax: "{{ route('departments.index') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, sClass: 'text-center'},
                    {data: 'name', name: 'name'},
                    {data: 'code', name: 'code'},
                    {data: 'institution', name: 'institution'},
                    {data: 'description', name: 'description'},
                    {data: 'actions', name: 'action', orderable: false, searchable: false, sClass: 'text-center'},
                ]
            });


            $(".data-depart").on("click", function () {

                var actionUrl = "{{ route("departments.store") }}";
                $("#formDepart").attr("action", actionUrl);
                $("#formDepart").attr("method", "POST");

                $("#departModal").modal("show");
                $("#formDepart").show();
                $("#formDepart")[0].reset();
                $("#formShowDetails").hide();
                $('.institution-select2').val(null).trigger('change');
                $("#departLabel").empty().html("Add Department");
            });

            $(".institution-select2").select2({
                placeholder: "Search Institution...",
                dropdownParent: $('#departModal'),
                allowClear: true
            });

            $('#departModal').on('shown.bs.modal', function() {
                // This event is triggered when the modal is shown
                // You can perform any initialization here
            });

            $('#departModal').on('shown.bs.modal', function() {
                // This event is triggered when the modal is shown
                // You can perform any initialization here
                //$("#departLabel").html("Add Department");
            });

            $(document).on("click", ".depart-show", function () {
                var endpoint = $(this).data("endpoint");
                $("#formDepart").hide();
                $.ajax({
                    method : "GET",
                    url: endpoint,
                    dataType : "json",
                    success : function (response) {
                        console.log("show");
                        console.log(endpoint);
                        console.log(response);


                        $("#formShowDetails").show();

                        console.log(response);
                        $("#departLabel").empty().html("Department Details");
                        var tbody = $("#formShowDetails tbody");
                        $("tr #name").html(response.name);
                        $("tr #code").html(response.code);
                        $("tr #desc").html(response.description);
                        $("tr #institution").html(response.institution.name);
                        $("tr #date_added").html(response.created_at + ", By " + response.created_by);
                        $("tr #date_modified").html(response.updated_at + ", By " + response.updated_by);
                        $("#departModal").modal("show");

                    },
                    error : function (error) {
                        console.log(error);
                    }

                });
            });

            $(document).on("click", ".depart-edit", function () {
                var endpoint = $(this).data("endpoint");
                var departId = $(this).data("id");
                $("#formDepart").show();
                $("#formShowDetails").hide();
                var actionUrl = "{{ url('departments/update') }}";
                $.ajax({
                    method : "GET",
                    url: endpoint,
                    dataType : "json",
                    success : function (response) {
                        $("#formDepart").attr("action", actionUrl)
                               .attr("method", "POST");
                        console.log(response);
                         $("#departLabel").empty().html("Edit Department");
                         $("input[name='name']").val(response.name);
                         $("input[name='departId']").val(response.id);
                         $("input[name='code']").val(response.code);
                         $("textarea[name='description']").val(response.description);
                         var select2Institution = $(".institution-select2");
                         select2Institution.append(new Option(response.institution.name, response.institution.id, true, true));
                         select2Institution.trigger("change");
                         $("#departModal").modal("show");
                    },
                    error : function (error) {
                        console.log(error);
                    }

                });
            });

            $(document).on("click", ".depart-delete", function () {
                var id = $(this).data("id");
                $.ajax({
                    method : "GET",
                    url: "{{ url("departments") }}"+"/"+id+"/"+"delete",
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success : function (response) {
                        console.log(response);
                        table.draw();
                    },
                    error : function (error) {
                        console.log(error);
                    }

                });
            });

        })
    </script>
@endsection
