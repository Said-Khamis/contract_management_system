@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Approval Group
        </h1>
    </section>
    <div class="content">
        <div class="box box-primary">
            <div class="box-body">
                <div class="row" style="margin-left: -18px">
                    @include('approval_groups.show_fields')
                    <a href="{!! route('approvalGroups.index') !!}" class="btn btn-default" style="margin-left: 15px">Back</a>
                </div>
            </div>
        </div>
    </div>
@endsection
