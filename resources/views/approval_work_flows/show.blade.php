@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Approval Flow
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="margin-left: -18px">
                    @include('approval_work_flows.show_fields')
                    <a href="{!! route('approvalWorkFlows.index') !!}" class="btn btn-default" style="margin-left: 15px">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
