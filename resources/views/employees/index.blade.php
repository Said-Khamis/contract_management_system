@extends('layouts.master')

@section('content')

    @section('title', 'Manage Employees')
    @component('components.breadcrumb')
        @slot('sub_title')
            Employees
        @endslot
        @slot('action')
            List
        @endslot
    @endcomponent

    <div class="row mb-2">
        <div class="col text-end">
            @if(Request::is('employees'))
                <a href="javascript:void(0)" class="btn btn-primary data-modal" data-bs-toggle="modal" data-url="{{ route('employees.create') }}">
                    <i class=" bx bx-plus text-green"></i>&ensp; Add Employee
                </a>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">List of Employees</h4>
                </div>
                <div id="table-fixed-header">
                    @include('employees.table')
                </div>
                <div class="card-footer">
                    {{$employees->links()}}
                </div>
            </div>
        </div>
    </div>

@endsection