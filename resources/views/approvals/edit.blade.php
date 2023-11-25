@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Approval
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">
            <div class="box-body">
                <div class="row">
                    {!! Form::model($approval, ['route' => ['approvals.update', $approval->id], 'method' => 'patch']) !!}

                    @include('approvals.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection