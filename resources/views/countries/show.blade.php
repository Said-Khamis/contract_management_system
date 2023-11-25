{{--@extends('layouts.master')--}}

{{--@section('content')--}}
{{--    @component('components.breadcrumb')--}}
{{--        @slot('li_1')--}}
{{--            Country--}}
{{--        @endslot--}}
{{--        @slot('title')--}}
{{--            Country Details--}}
{{--        @endslot--}}
{{--    @endcomponent--}}


    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Details of
                        <span>{{ ucwords($country->name) }}</span></h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="row">
                        @include('countries.show_fields')
                    </div>
                </div><!-- end card-body -->

                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary data-modal" data-url="{{ route('countries.edit', [$country->id]) }}">
                        <i class="ri-pencil-fill align-bottom me-2">
                        </i>Edit
                    </button>
                </div>

            </div><!-- end card -->
        </div>
        <!-- end col -->
    </div>
{{--@endsection--}}
