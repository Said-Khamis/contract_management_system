{{--@extends('layouts.master')--}}

{{--@section("content")--}}

<section class="content-header">
    <div class="content px-3">
            <div class="card">
               {{-- <div class="card-header">
                    <div class="col-sm-12">
                        <span>Create Department</span>
                        <a href="{{route('departments.index')}}" class="btn btn-outline-secondary btn-sm float-end" >
                            <span class="icon-on"><i class="ri-arrow-left-line align-bottom me-1"></i> Back</span>
                        </a>
                    </div>
                </div>--}}
                {!! Form::open(['route' => 'departments.store', 'method' => 'post']) !!}
                <div class="card-body">
                    <div class="row">
                        @include('departments.fields')
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                </div>
                {!! Form::close() !!}
            </div>
        </div>
</section>

    {{--@endsection--}}