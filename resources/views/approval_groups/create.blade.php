@extends('layouts.master')

@section('content')
    <div class="content">
        <div class="clearfix"></div>
        <div class="card">
            <div class="card-header">
                <div class="pull-left">
                    Add Approval Group
                </div>
            </div>
            <div class="card-body">
                <div class="row">
                    {!! Form::open(['route' => 'approvalGroups.store']) !!}
                        @include('approval_groups.fields')
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
