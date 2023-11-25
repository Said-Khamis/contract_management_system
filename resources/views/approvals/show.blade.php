@extends('layouts.app')

@section('content')
    <section class="content-header">
        @include('layouts._approval_header')
    </section>
    <div class="content">
        <div class="clearfix"></div>
        @include('flash::message')
            <div class="clearfix"></div>
                <div class="box box-primary">
                    <div class="box-sub-menu">
                        <div class="pull-left title">
                            Approve {{$approval->approvable_type}}
                        </div>
                        <div class="sub-menu pull-right">
                            <!-- actions which are available in approval context-->
                            <a class=" pull-right menu" data-toggle="modal" style="cursor: pointer;"
                               data-target="#approve{{$approval->id}}"
                               title="Approve/reject">
                                <i class="fa fa-plus"></i> approve/reject </a>
                        </div>
                    </div>
                </div>

            {{--@include('layouts._horizontal_line')--}}
            <div class="box-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel-custom gutter-custom-top">
                            <div class="panel panel-primary">
                                <div class="panel-heading">Approval Details</div>
                                    <div class="panel-body">
                                        <div class="container-fluid">
                                            <table class="table table-striped table-bordered" id="employees" >
                                                <tbody>
                                                    <tr>
                                                        <div>
                                                            <td style="font-weight: bold">Type</td>
                                                            <td>{{$approval->approvable_type}}</td>
                                                        </div>
                                                    </tr>
                                                    <tr>
                                                        <div>
                                                            <td style="font-weight: bold">Ref #</td>
                                                            <td>{{$approval->is_approved }}</td>
                                                            {{--<td>{{ $approvable->reference_no }}</td>--}}
                                                        </div>
                                                    </tr>
                                                    <tr>
                                                        <div>
                                                            <td style="font-weight: bold">Status</td>
                                                            {{--<td>{{$approval->is_approved }}</td>--}}
                                                            <td style="color: #00ca6d">{{ $approval->status }}</td>
                                                        </div>
                                                    </tr>
                                                    <tr>
                                                        <div>
                                                            <td style="font-weight: bold">Currently Approved</td>
                                                            <td>{{ getRoleName($approval->current_approval_role_id) }}</td>
                                                        </div>
                                                    </tr>
                                                    <tr>
                                                        <div>
                                                            <td style="font-weight: bold">Created At</td>
                                                            <td>{{prettyDate($approval->created_at)}}</td>
                                                        </div>
                                                    </tr>
                                                    <tr>
                                                        <div>
                                                            <td style="font-weight: bold">Created By</td>
                                                            <td>{{ getCreatedByName($approval->created_by) }}</td>
                                                        </div>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                            </div>
                        </div>
                    </div>
                </div>

                        @if($approval->approvable instanceof \App\Models\Procurement\PurchaseOrder)
                            @include('purchase_orders._show_panel_approval')

                        @elseif($approval->approvable instanceof \App\Models\Requisition\GoodRequisition)
                            @include('good_requisitions._show_panel_approval')

                        @elseif($approval->approvable instanceof \App\Models\Requisition\JobCard)
                            @include('job_cards._show_panel_approval')

                        @elseif($approval->approvable instanceof \App\Models\Requisition\CheckList)
                            @include('check_lists._show_panel_approval')
                        @endif


                {{-- side bar--}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel-custom gutter-custom-top ">
                            <div class="panel panel-default panel-primary">
                                <div class="panel-heading">Approval History</div>
                                <div class="panel-body">
                                    <div class="container-fluid">
                                        <table class="table table-striped table-bordered" id="employees" >
                                            <tbody>
                                                @foreach($approvalHistories as $approvalHistory)
                                                    <div>
                                                        @if($approvalHistory->is_approved)
                                                            <tr>
                                                                <td style="font-weight: bold">Approved By</td>
                                                                <td>{{ $approvalHistory->role->name  }}</td>
                                                            </tr>
                                                        @else
                                                            <tr>
                                                                <td style="font-weight: bold">Rejected By</td>
                                                                <td>{{ $approvalHistory->role->name }}</td>
                                                            </tr>
                                                        @endif
                                                    </div>
                                                            <tr>
                                                                <td style="font-weight: bold">Reason</td>
                                                                <td>{{ $approvalHistory->comment }}</td>
                                                            </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="row" style="margin-left: 0px">
                    <a href="{!! route('approvals.index') !!}" class="btn btn-default">Back</a>
                </div>

                    @include('approvals._modal_approve')
            </div>
    </div>

@endsection
