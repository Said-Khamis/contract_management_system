@extends('layouts.master')
@section('title', 'Manage Designations')

@section('content')

    @component('components.breadcrumb')
        @slot('sub_title')
            Designations
        @endslot
        @slot('action')
            List
        @endslot
    @endcomponent

    @include("designations._designation_modal")

    <div class="row mb-2">
        <div class="col text-end">
            {{--@if(Request::is('designations'))--}}
               {{-- <a href="javascript:void(0)" class="btn btn-primary data-moda" data-bs-toggle="modal" data-url="{{ route('designations.create') }}">
                    <i class=" bx bx-plus text-green"></i> Add Designations
                </a>--}}
            <a href="javascript:void(0)" class="btn btn-primary data-designation" data-bs-toggle="modal" data-url="{{ route('designations.create') }}">
                <i class=" bx bx-plus text-green"></i> Add Designations
            </a>
            {{--@endif--}}
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">List of Designations</h4>
                </div><!-- end card header -->
                <div class="card-body">

                    {{--
                      {{ $designations }}
                      {{ auth()->user()->institution }}
                      {{ auth()->user()->roles }}
                    --}}

                    <div id="table-fixed-header">
                        {{--@include('designations.table')--}}
                        <div class="table-responsive">
                            <table cellspacing="0" class="table table-sm table-striped table-bordered table-nowrap align-middle mb-0" width="100%" id="designations-table">
                                <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>Title</th>
                                    <th>Descriptions</th>
                                    <th>Institution</th>
                                    <th class="text-center" colspan="3">Action</th>
                                </tr>
                                </thead>
                                {{--JQUERY DATATABLE --}}
                            </table>
                        </div>
                    </div>

                </div><!-- end card-body -->
               {{-- <div class="card-footer">
                    {{$designations->links()}}
                </div>--}}
            </div><!-- end card -->
        </div>
        <!-- end col -->
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

            var table = $('#designations-table').DataTable({
                searching: true,
                processing: true,
                serverSide: true,
                autoWidth: false,
                pageLength: 10,
                ajax: "{{ route('designations.index') }}",

                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false, sClass: 'text-center'},
                    {data: 'title', name: 'title'},
                    {data: 'description', name: 'description'},
                    {data: 'institution', name: 'institution'},
                    {data: 'actions', name: 'action', orderable: false, searchable: false, sClass: 'text-center'},
                ]
            });

            $(".institution-select2").select2({
                placeholder: "Search Institution...",
                dropdownParent: $('#designationModal'),
                allowClear: true
            });

            $(".department-select2").select2({
                placeholder: "Search Department...",
                dropdownParent: $('#designationModal'),
                allowClear: true
            });

            $(document).on("click", ".data-designation", function () {

                var actionUrl = "{{ route("designations.store") }}";
                $("#formDesignation").attr("action", actionUrl)
                    .attr("method", "POST");
                $("#departLabel").empty().html("Add Designation");

                $("input[name='designId']").val(" ");
                $("#formDesignation").show();
                $("#formDesignation")[0].reset();
                $("#formShowDetails").hide();
                $('.institution-select2').val(null).trigger('change');

                $("#designationModal").modal("show");
            });

            $(document).on("click", ".design-show", function () {
                var endpoint = $(this).data("endpoint");
                $("#formDesignation").hide();
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
                        $("#departLabel").empty().html("Designation Details");
                        var tbody = $("#formShowDetails tbody");
                        $("tr #title").html(response.title);
                        $("tr #desc").html(response.description);
                        $("tr #institution").html(response.institution.name);
                        $("tr #date_added").html(response.created_at + ", By " + response.created_by);
                        $("tr #date_modified").html(response.updated_at + ", By " + response.updated_by);
                        $("#designationModal").modal("show");

                    },
                    error : function (error) {
                        console.log(error);
                    }

                });
            });

            $(document).on("click", ".design-edit", function () {
                var endpoint = $(this).data("endpoint");
                var departId = $(this).data("id");

                $("#formDesignation").show();
                $("#formShowDetails").hide();

                var actionUrl = "{{ url('designations/update/') }}";

                $.ajax({
                    method : "GET",
                    url: endpoint,
                    dataType : "json",
                    success : function (response) {
                        $("#formDesignation").attr("action", actionUrl)
                            .attr("method", "POST");
                        console.log(response);
                        $("#departLabel").empty().html("Edit Designation");
                        $("input[name='title']").val(response.title);
                        $("input[name='designId']").val(departId);
                        $("textarea[name='description']").val(response.description);
                        var select2Institution = $(".institution-select2");
                        select2Institution.append(new Option(response.institution.name, response.institution.id, true, true));
                        select2Institution.trigger("change");
                        $("#designationModal").modal("show");
                    },
                    error : function (error) {
                        console.log(error);
                    }

                });
            });

            $(document).on("click", ".design-delete", function () {
                var id = $(this).data("id");
                $.ajax({
                    method : "GET",
                    url: "{{ url("designations") }}"+"/"+id+"/"+"delete",
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

        });

    </script>
@endsection

