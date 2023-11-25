<!-- Page header -->
<div class="page-header d-print-none mb-2" style="position: static;top: 200px;">
    <div class="container-fluid">
        <div class="row g-2 align-items-center">
            <div class="col">
                <!-- Page pre-title -->
                {{--                <div class="page-pretitle">Overview</div>--}}
                <h2 class="page-title">Approvals</h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <div class="mx-4">
                        <a href="{{route('approvalGroups.index')}}" class="btn btn-default float-right">
                            Approval Groups
                        </a>
                    </div>
                    <a href="{{route('approvalWorkFlows.index')}}" class="btn btn-default float-right">
                        Approval Workflow
                    </a>
                    @if(Request::segment(Request::segment(2) == 'approvalGroups'))
                        <a href="{{route('approvalGroups.create')}}" class="btn btn-primary d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="icon"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            New Group
                        </a>
                    @elseif(Request::segment(Request::segment(2) == 'approvalWorkFlows'))
                        <a href="{{route('approvalWorkFlows.create')}}" class="btn btn-primary d-none d-sm-inline-block">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                class="icon"
                                width="24"
                                height="24"
                                viewBox="0 0 24 24"
                                stroke-width="2"
                                stroke="currentColor"
                                fill="none"
                                stroke-linecap="round"
                                stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            New Workflow
                        </a>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
