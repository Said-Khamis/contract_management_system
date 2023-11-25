@extends('layouts.master')

@section('content')
    <div class="row">
        <div class="col">
            @include('approvals._approval_menu')
        </div>
    </div>
    <div class="row">
        <div class="col px-2">
            <div class="card">
                @include('approval_groups.table')
            </div>
        </div>
    </div>
@endsection

