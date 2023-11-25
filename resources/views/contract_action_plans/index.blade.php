{{--@extends('layouts.master')--}}
{{--@section('title', 'Manage Action Plans')--}}
{{--@component('components.breadcrumb')--}}
{{--    @slot('sub_title')--}}
{{--        Categories--}}
{{--    @endslot--}}
{{--    @slot('action')--}}
{{--        List--}}
{{--    @endslot--}}
{{--@endcomponent--}}
{{--@section('content')--}}
{{--    <div class="row mb-2">--}}
{{--        <div class="col text-end">--}}
{{--            @if(Request::is('contractActionPlans'))--}}
{{--                <a href="javascript:void(0)" class="btn btn-primary data-modal" data-bs-toggle="modal" data-url="{{ route('contractActionPlans.create') }}">--}}
{{--                    <i class=" bx bx-plus text-green"></i>&ensp; Add Action Plans--}}
{{--                </a>--}}
{{--            @endif--}}
{{--        </div>--}}
{{--    </div>--}}

{{--    <div class="row">--}}
{{--        <div class="col-lg-12">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">--}}
{{--                    <h4 class="card-title mb-0">List of Action Plans</h4>--}}
{{--                </div><!-- end card header -->--}}
{{--                <div id="table-fixed-header">--}}
{{--                    @include('contract_action_plans.table')--}}
{{--                </div>--}}
{{--                <div class="card-footer">--}}
{{--                </div>--}}
{{--            </div><!-- end card -->--}}
{{--        </div>--}}
{{--        <!-- end col -->--}}
{{--    </div>--}}

{{--@endsection--}}
