@extends('layouts.master')

@section('content')

    @include("implementation_statuses._modal_add_implementation")
    @include("implementation_statuses._modal_add_general_status")

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2 d-flex flex-row-reverse">
                <div class="col-sm-6 text-end">
                    <a href="{{ url()->previous() }}" class="btn-lg btn-primary">
                        <i class="bx bx-arrow-back mr-2"></i>Back
                    </a>
                </div>
            </div>
        </div>
    </section>

    @if(count($dataArrayImplementations["data"]) > 0)
         <div class="content px-3 mt-3">
             <div class="clearfix"></div>
             <div class="card">
                 <div class="card-header">
                     <div class="row mb-1">
                         <div class="col-sm-6 card-title">
                             <h4>Implementation Statuses</h4>
                         </div>
                         @if($dataArrayImplementations["type"] == "contract_general_status")
                             <div class="col-sm-6 text-end">
                                 <a class="btn btn-primary float-right" id="add_new_implementation">
                                     Add New
                                 </a>
                             </div>
                         @endif
                     </div>
                 </div>
                 <div class="card-body px-2">
                     <div class="accordion accordion-flush custom-accordionwithicon custom-accordion-border accordion-border-box accordion-primary" id="accordionImplementation">
                         @foreach($dataArrayImplementations["data"] as $key => $data)
                             <div class="accordion-item">
                                 <h2 class="accordion-header" id="headingOne">
                                     <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_{{ $data->id }}" aria-expanded="true" aria-controls="collapseOne">
                                         {{  $data->area ?? $data->details }}
                                     </button>
                                 </h2>
                                 <div id="collapse_{{ $data->id }}" class="accordion-collapse collapse"
                                      aria-labelledby="headingOne" data-bs-parent="#accordionImplementation">
                                     <div class="accordion-body">
                                         <h1></h1>
                                         <div class="col">
                                             <div class="d-flex flex-row justify-content-between">
                                                 <button class="btn btn-danger btn-sm rounded-pill deleteAllStatus">
                                                     <i class="bx bxs-trash"></i> Delete <span></span>
                                                 </button>
                                                 <button data-index="{{ $key }}"
                                                         data-tablekey="table_status_{{ $key }}"
                                                         data-id="table_{{ $key }}"
                                                         data-uid = "{{ $data->id }}"
                                                         data-type="{{ $dataArrayImplementations["type"] }}"
                                                         class="btn btn-primary btn-sm rounded-pill addStatus" >
                                                     <i class="bx bx-plus"></i> Add
                                                 </button>
                                             </div>
                                             <div class="mt-sm-3">
                                                 <table class="table table-striped" id="table_status_{{ $key }}">
                                                     <thead>
                                                       <tr>
                                                         <td><input class="checkAll" type="checkbox" ></td>
                                                         <td>Percent (%) </td>
                                                         <td>Comment (s)</td>
                                                         <td style="width: 20%; text-align: end;">Date Added</td>
                                                         <td style="width: 10%; text-align: end;">Action</td>
                                                       </tr>
                                                     </thead>
                                                     <tbody id="table_{{ $key }}">
                                                        @if(count($data["statuses"]) > 0)
                                                            @foreach($data["statuses"] as $k => $status)
                                                                 <tr style="width: 100%" id="tr_{{ $key }}_{{ $status->id   }}">
                                                                    <td>
                                                                        <input type="checkbox" class="checkboxes" value="{{ $status->id }}"/>
                                                                    </td>
                                                                    <td style="width: 10%;" id="td_per_{{ $key }}_{{ $status->id   }}">{{ $status->percent }}</td>
                                                                    <td id="td_com_{{ $key }}_{{ $status->id   }}">{!! html_entity_decode($status->comment) !!}</td>
                                                                    <td style="width: 20%; text-align: end;" >{{ $status->created_at }}</td>
                                                                    <td style="width: 10%; text-align: end;" class="text-end">
                                                                        <a data-uid="{{ $status->id }}"
                                                                            data-per="td_per_{{ $key }}_{{ $status->id  }}"
                                                                            data-com="td_com_{{ $key }}_{{ $status->id  }}"
                                                                            data-table="table_status_{{ $key }}"
                                                                            data-index="{{ $key }}"
                                                                            class="text-primary editStatus"
                                                                            data-bs-toggle="tooltip"
                                                                            data-bs-placement="left"
                                                                            title="Edit">
                                                                             <i class="bx bx-edit"></i>
                                                                        </a>
                                                                        <a data-uid ="{{ $status->id }}"
                                                                            data-tr="tr_{{ $key }}_{{ $status->id }}"
                                                                            class="text-danger deleteStatus"
                                                                            data-bs-toggle="tooltip"
                                                                            data-bs-placement="left"
                                                                            title="Delete">
                                                                             <i class="bx bx-trash"></i>
                                                                        </a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                        @endif
                                                     </tbody>
                                                 </table>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         @endforeach
                     </div>
                 </div>
                 <div class="card-footer clearfix">
                     <div class="float-right">
                     </div>
                 </div>
             </div>
         </div>
     @endif

@endsection

@section("script")
    <script type="text/javascript">
        $(function (){

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            let tdPer, tdCom, dataURl , method , type ,
                implementable_id , accId ,id  , accordIndex , trDelete =  " ";

            $('#comments').summernote({
                placeholder: 'Add Comments',
                tabsize: 2,
                toolbar: [
                    ['style', ['bold', 'italic', 'underline', 'clear']],
                    ['font', ['strikethrough', 'superscript', 'subscript']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph']],
                    ['height', ['height']]
                ],
                fontNames: ['Arial', 'Arial Black', 'Comic Sans MS', 'Courier New'],
                fontSizes: [10, 12, 14, 16, 18, 24, 36]
            });

            $(document).on("click",".addStatus", function (){
                dataURl = "{{ route("implementationStatuses.store") }}";
                method = "POST";
                type = $(this).data("type");
                implementable_id = $(this).data("uid");
                accId = $(this).data("id");
                accordIndex = $(this).data("index");

                console.log(accId);
                console.log(type);
                console.log(accordIndex);

                $("#addStatusModal").modal("show");
            });

            $(document).on("click",".editStatus", function (){
                id = $(this).data("uid");
                let url = "{{ route("implementationStatuses.edit", [":id"]) }}".replace(":id",id);
                let method1 = "GET";

                accordIndex = $(this).data("index");

                method = "PUT";
                dataURl = "{{ route("implementationStatuses.update",[":id"]) }}".replace(":id",id);

                tdPer = $(this).data("per");
                tdCom = $(this).data("com");

                console.log(tdPer);
                console.log(tdCom);
                console.log(accordIndex);

                //type = $(this).data("type");
                //implementable_id = $(this).data("uid");
                //accId = $(this).data("id");

                $.ajax({
                    method: method1,
                    url: url,
                    dataType: "json",
                })
                    .done(function (response){
                     console.log("Response");
                     console.log(response);
                     if(response.result !== null){
                         $("#addStatusModal").modal("show");
                         $("#percent").val(response.result.percent);
                         $("#comments").summernote("code", response.result.comment);
                         $("#contractId").val(response.result.contract_id);
                     }
                })
                    .fail(function (error){
                    console.log(error);
                })
                    .always(function (){

                });
            });

            $(document).on("click",".deleteStatus", function (){
                id = $(this).data("uid");
                let url = "{{ route("destroy.status") }}";
                let method1 = "DELETE";

                trDelete = $(this).data("tr");

                tdPer = $(this).data("per");
                tdCom = $(this).data("com");

                console.log("TR-Delete");
                console.log(trDelete);

                let data = [{ "id" : id }];
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
                            url: url,
                            method: method1,
                            contentType: 'application/json',
                            dataType: "json",
                            data: JSON.stringify(data),
                            headers: {
                                'X-CSRF-TOKEN': "{{ csrf_token() }}"
                            },
                        }).done(function (response){
                                console.log("Response");
                                console.log(response);
                                if(response.status === true){
                                    Swal.fire(
                                        'Deleted!',
                                        'Implementation  has been deleted.',
                                        'success'
                                    );
                                    $("#"+trDelete).remove();
                                }
                            })
                            .fail(function (error){
                                console.log(error);
                            })
                            .always(function (){});
                    }
                })
            });

            let myModalEl = $('#addStatusModal');
            myModalEl.on('shown.bs.modal', function (event) {
                $("#savingBtn").hide();
                //$("#formImplementation")[0].reset();
            });
            myModalEl.on('hidden.bs.modal', function (event) {
                $("#savingBtn").hide();
                 dataURl = " ";
                 implementable_id = " ";
                 method = " ";
                 $("#area").val(null);
                 $("#percent").val(null);
                 $('#comments').summernote('reset');
            });

            $("#addGeneralStatusModal").on('hidden.bs.modal', function (event) {
                const area =  $("#area");
                $("#savingBtnGeneral").hide();
                area.val(null);
                area.removeClass("is-valid");
                area.removeClass("is-invalid");
            });

            $.validator.addMethod("requiredSummernote",
                function() {
                return !($("#comments").summernote('isEmpty'));
            },
                "Comment(s) field is required.");

            $(".error_comments").hide();
            $(".error_percent").hide();
            $(".error_area").hide();

            $("#savingBtnGeneral").hide();

            let percent = $("#percent");
            let area = $("#area");

            $("#saveBtn").on("click" ,function (){
                let summernoteContent = $('#comments').summernote('isEmpty');
                if ( percent.val() === "") {
                    percent.addClass("is-invalid");
                    $(".error_percent").html("Implemented Area is a required field").show();
                }else if(percent.val() > 100){
                    percent.addClass("is-invalid");
                    $(".error_percent").html("Percent should not exceed 100").show();
                } else if (summernoteContent) {
                   $(".error_comments").show();
                } else {
                    percent.removeClass("is-invalid");
                    percent.addClass("is-valid");
                    $(".error_comments").hide();
                    $(".error_percent").hide();

                    let data = {
                        "contract_id" : $("#contractId").val(),
                        "_token" : "{{ csrf_token() }}",
                        "percent" : percent.val(),
                        "comments" : $("#comments").summernote("code"),
                        "type" : type===""?"":type,
                        "id" : implementable_id
                    };
                    console.log("Data");
                    console.log(data);

                    $.ajax({
                        url: dataURl,
                        method: method,
                        data: data,
                        dataType: "json",
                        beforeSend: function (){
                            $("#savingBtn").show();
                            $("#saveBtn").hide();
                        }
                      })
                        .done(function (response){
                            let msg;
                            console.log("Data");
                            console.log(response);
                            if (response.status === true) {
                                myModalEl.modal("hide");
                                msg = "";
                                if(!response.hasOwnProperty("newStatus")){
                                    $('#'+tdPer ).empty().html(response.result.percent);
                                    $('#'+tdCom ).empty().html(response.result.comment);
                                    msg = "Implementation was Successfully Updated";
                                }else {

                                    let newRow = '<tr style="width: 100%" id="tr_'+accordIndex+'_'+response.newStatus.id+'">' +
                                            '<td><input type="checkbox" class="checkboxes" value="'+response.newStatus.id+'"/> </td>' +
                                            '<td style="width: 10%;" id="td_per_'+accordIndex+'_'+response.newStatus.id+'">'+response.newStatus.percent+'</td>' +
                                            '<td id="td_com_'+accordIndex+'_'+response.newStatus.id+'">'+response.newStatus.comment+'</td>' +
                                            '<td style="width: 20%; text-align: end;">'+response.newStatus.created_at+'</td>' +
                                            '<td style="width: 10%; text-align: end;" class="text-end">' +
                                            '<a data-uid="'+response.newStatus.id+'" ' +
                                               'data-per="td_per_'+accordIndex+'_'+response.newStatus.id+'"' +
                                               'data-com="td_com_'+accordIndex+'_'+response.newStatus.id+'" ' +
                                               'data-table="table_status_'+accordIndex+'" ' +
                                               'data-index="'+accordIndex+'" ' +
                                               'class="text-primary editStatus" data-bs-toggle="tooltip" data-bs-placement="left" title="Edit">' +
                                                 '<i class="bx bx-edit"></i>'+
                                            '</a>' +
                                             '<a data-uid="'+response.newStatus.id+'" ' +
                                               'data-tr="tr_'+accordIndex+'_'+response.newStatus.id+'"' +
                                               'class="text-danger deleteStatus" data-bs-toggle="tooltip" ' +
                                               'data-bs-placement="left" title="Delete" >' +
                                                '<i class="bx bx-trash"></i>'+
                                              '</a>' +
                                            '</td>' +
                                            '</tr>';

                                        $('#'+accId ).prepend(newRow);
                                        msg = "Implementation was Successfully Added";
                                    }
                            }
                            Swal.fire(
                                'Success Message',
                                 msg,
                                'success'
                            );
                            $("#savingBtn").hide();
                            $("#saveBtn").show();
                        })
                        .fail(function (error){
                            console.log(error);
                            $("#savingBtn").hide();
                            $("#saveBtn").show();
                         })
                        .always(function() {
                            $("#savingBtn").hide();
                            $("#saveBtn").show();
                    });
                }
            });

            $("#saveBtnGeneral").on("click" ,function (){
                if ( area.val()==="") {
                    area.addClass("is-invalid");
                    $(".error_area").show();
                }
                else {
                    let data = {
                        "contract_id" : $("#contractId").val(),
                        "_token" : "{{ csrf_token() }}",
                        "area" : area.val(),
                    };
                    console.log("Data");
                    console.log(data);

                    $.ajax({
                        url: "{{ route("generalStatuses.store") }}",
                        method: "POST",
                        data: data,
                        dataType: "json",
                        beforeSend: function (){
                            $("#savingBtnGeneral").show();
                            $("#saveBtnGeneral").hide();
                        }
                    })
                        .done(function (response){
                            let msg , isSuccess;
                            console.log("Data");
                            console.log(response);
                            let type = "{{ $dataArrayImplementations["type"] }}";
                            if (response.status === true) {
                                msg = "";
                                let newRow = '<div class="accordion-item">' +
                                    '<h2 class="accordion-header" id="headingOne">' +
                                      '<button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapse_'+response.gStatus.id +'" aria-expanded="true" aria-controls="collapseOne">'+ response.gStatus.area +'</button> ' +
                                    '</h2> ' +
                                    '<div id="collapse_'+response.gStatus.id +'" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionImplementation"> ' +
                                    '<div class="accordion-body">' +
                                    ' <h1></h1> ' +
                                    '<div class="col"> ' +
                                    '<div class="d-flex flex-row justify-content-between"> ' +
                                    '<button ' +
                                       'data-type = "'+type+'" ' +
                                       'data-uid = "'+response.gStatus.id +'"' +
                                       ' class="btn btn-danger btn-sm rounded-pill addStatus" >' +
                                       ' <i class="bx bxs-trash"></i> Delete ' +
                                    '</button>' +
                                    ' <button data-index=""' +
                                       'data-uid = "'+response.gStatus.id +'"' +
                                       'data-tablekey="table_status_"' +
                                       'data-id="table_" data-uid = "" ' +
                                       'data-type="'+type+'" ' +
                                       'class="btn btn-primary btn-sm rounded-pill addStatus" >' +
                                       '<i class="bx bx-plus"></i> Add </button>' +
                                    ' </div> ' +
                                    '<div class="mt-sm-3">' +
                                    ' <table class="table table-striped" id="table_status_">' +
                                        ' <thead>' +
                                        ' <tr> ' +
                                          '<td><input class="checkAll"  type="checkbox"></td>' +
                                        ' <td>Percent (%) </td> ' +
                                        '<td>Comment (s)</td> ' +
                                        '<td style="width: 20%; text-align: end;">Date Added</td> ' +
                                        '<td style="width: 10%; text-align: end;">Action</td> ' +
                                        '</tr> ' +
                                        '</thead>' +
                                        ' <tbody id="table_">' +

                                        '</tbody> ' +
                                       '</table>' +
                                      ' </div> ' +
                                    '</div> ' +
                                    '</div> ' +
                                    '</div> ' +
                                    '</div>';

                                $('#accordionImplementation').prepend(newRow);

                                msg = "Implementation was Successfully Added";
                                isSuccess = "success";
                            }
                            else {
                                msg = "Error while Submit Data";
                                isSuccess = "error";
                            }

                            $("#addGeneralStatusModal").modal("hide");

                            Swal.fire(
                                'Message',
                                msg,
                                isSuccess
                            );
                            $("#savingBtnGeneral").hide();
                            $("#saveBtnGeneral").show();
                        })
                        .fail(function (error){
                            console.log(error);
                            $("#savingBtnGeneral").hide();
                            $("#saveBtnGeneral").show();
                        })
                        .always(function() {
                            $("#savingBtnGeneral").hide();
                            $("#saveBtnGeneral").show();
                        });
                }
            });

            $(document).on("change" ,"#percent", function (){
                if ( percent.val() === "") {
                    percent.addClass("is-invalid");
                    $(".error_percent").html("Implemented Area is a required field").show();
                }else if(percent.val() > 100){
                    percent.addClass("is-invalid");
                    $(".error_percent").html("Percent should not exceed 100").show();
                }else{
                    percent.removeClass("is-invalid");
                    percent.addClass("is-valid");
                    $(".error_percent").hide();
                }
            });

            $(document).on("change" ,"#area", function (){
                if ( area.val() === "") {
                    area.addClass("is-invalid");
                    $(".error_area").show();
                }else{
                    area.removeClass("is-invalid");
                    area.addClass("is-valid");
                    $(".error_area").hide();
                }
            });

            $("#add_new_implementation").on("click", function (){
                 $("#addGeneralStatusModal").modal("show");
            });

            const accordionItems = $('.accordion-item');

            accordionItems.on('click', '.checkAll', function() {
                $(this).closest('.accordion-item')
                    .find('.checkboxes')
                    .prop('checked', this.checked);
            });

            accordionItems.on('change', '.checkboxes', function() {
                const allChecked = $(this).closest('.accordion-item')
                    .find('.checkboxes').length ===
                     $(this).closest('.accordion-item').find('.checkboxes:checked').length;

                $(this).closest('.accordion-item')
                    .find('.checkAll').prop('checked', allChecked);

            });

            accordionItems.on('change', '.checkboxes', function() {
                const accordionItem = $(this).closest('.accordion-item');
                const total = accordionItem.find('.checkboxes:checked').length;
                accordionItem.find('.deleteAllStatus span').empty().append("(" + total + ")");
            });

            accordionItems.on('change', '.checkboxes', function() {
                const accordionItem = $(this).closest('.accordion-item');
                const total = accordionItem.find('.checkboxes:checked').length;
                accordionItem.find('.deleteAllStatus span').empty().append("(" + total + ")");
            });

            accordionItems.on('change', '.checkAll', function() {
                const accordionItem = $(this).closest('.accordion-item');
                const totalChecked = accordionItem.find('.checkboxes:checked').length;
                accordionItem.find('.deleteAllStatus span').empty().html("(" + totalChecked + ")");
            });

            $(document).on('click', '.deleteAllStatus', function() {
                const accordionItem = $(this).closest('.accordion-item');
                const selectedData = [];
                accordionItem.find('.checkboxes:checked').each(function() {
                    const data = {id: $(this).val(),};
                    selectedData.push(data);
                });

                console.log("Array Data");
                console.log(selectedData);

                let url = "{{ route("destroy.status") }}";
                let methodDelete = "DELETE";

                if(selectedData.length > 0){
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
                                method: methodDelete,
                                url: url,
                                contentType: 'application/json',
                                dataType: "json",
                                data: JSON.stringify(selectedData),
                                headers: {
                                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                                }
                            }).done(function (response){
                                    if(response.status === true){
                                        Swal.fire(
                                            'Deleted!',
                                            'Implementation  has been deleted.',
                                            'success'
                                        );
                                        accordionItem.find('.checkboxes:checked').each(function() {
                                            $(this).closest("tr").remove();
                                        });
                                    }
                                })
                                .fail(function (error){

                                })
                                .always(function (){
                                });

                        }
                    });
                }

            });

        });
    </script>
@endsection

