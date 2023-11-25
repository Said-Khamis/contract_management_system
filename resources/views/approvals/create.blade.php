@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Approval
        </h1>
    </section>
    <div class="content">
        <div class="card">
            <div class="card-header">
                Create Approval
            </div>
            <div class="card-body">
                <div class="row">
                    {!! Form::open(['route' => 'approvals.store']) !!}
                    <div class="row">
                        @include('approvals.fields')
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
