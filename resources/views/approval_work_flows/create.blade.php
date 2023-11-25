@extends('layouts.master')

@section('content')
    <div class="content">
        <div class="card">
            <div class="card-header">
                Create Approval Work Flow
            </div>

            <div class="card-body">
                <div class="row">
                    {!! Form::open(['route' => 'approvalWorkFlows.store']) !!}

                    @include('approval_work_flows.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
