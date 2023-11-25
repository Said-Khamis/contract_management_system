@extends('layouts.master')
@section('content')
    <div class="row">
        <div class="col">
            @include('approvals._approval_menu')
        </div>
    </div>
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Approval Work Flow
                </div>
                @include('approval_work_flows.table')
            </div>
        </div>
    </div>
@endsection

