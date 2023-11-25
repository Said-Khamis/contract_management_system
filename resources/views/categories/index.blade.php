@extends('layouts.master')

@section('content')

    @section('title', 'Manage Categories')
    @component('components.breadcrumb')
        @slot('sub_title')
            Categories
        @endslot
        @slot('action')
            List
        @endslot
    @endcomponent

    <div class="row mb-2">
        <div class="col text-end">
            @if(Request::is('categories'))
                <a href="javascript:void(0)" class="btn btn-primary data-modal" data-bs-toggle="modal" data-url="{{ route('categories.create') }}">
                    <i class=" bx bx-plus text-green"></i>&ensp; Add Category
                </a>
            @endif
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">List of Categories</h4>
                </div><!-- end card header -->
                <div id="table-fixed-header">
                    @include('categories.table')
                </div>
                <div class="card-footer">
                    {{$categories->links()}}
                </div>
            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>

@endsection
