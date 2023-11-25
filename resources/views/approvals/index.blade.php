@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col">
            @include('approvals._approval_menu')
        </div>
    </div>
    <div class="row">
        <div class="mb-2 col">
            <!-- actions which are available in approval context-->
            @include('layouts._approval_header')
        </div>
    </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    @include('approvals.table')
                </div>
            </div>
        </div>
@endsection

