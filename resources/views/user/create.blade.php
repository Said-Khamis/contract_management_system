@extends('layouts.master')
@section( 'title','User Registration')
@section('content')
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                </div>
                <div class="col-md-6 mb-2">
                </div>
            </div>
        </div>
    </section>

    <div class="content px-3">

        <div class="card">
            <div class="card-header py-3">
                <span style="font-weight: bold; font-size: medium" class="mt-5">User Registration</span>
                <a href="{{route('user.index')}}" class="btn btn-outline-secondary btn-sm float-end" >
                    <span class="icon-on"><i class="ri-arrow-left-line align-bottom me-1"></i> Back</span>
                </a>
            </div>
            {!! Form::open(['route' => 'user.store']) !!}

            <div class="card-body">

                <div class="row">
                    @livewire('user', ['roles' => $roles])
                </div>

            </div>

            <div class="card-footer">
                <div class="float-end mb-3">
                    <a href="{{ route('user.index') }}" class="btn btn-light">Cancel</a>
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
