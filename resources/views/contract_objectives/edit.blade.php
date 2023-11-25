<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-12">
                <h5>Edit Contract Objective</h5>
            </div>
        </div>
    </div>
</section>

<div class="content px-3">
    <div class="card">
        {!! Form::model($contractObjective, ['route' => ['contractObjectives.update', $contractObjective->id], 'method' => 'patch']) !!}
        <div class="card-body">
            <div class="row">
                @include('contract_objectives.field_')
            </div>
        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
        </div>

        {!! Form::close() !!}

    </div>
</div>


{{--@extends('layouts.app')--}}
{{--@section('content')--}}
{{--    <section class="content-header">--}}
{{--        <div class="container-fluid">--}}
{{--            <div class="row mb-2">--}}
{{--                <div class="col-sm-12">--}}
{{--                    <h1>Edit Contract Objective</h1>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </section>--}}

{{--    <div class="content px-3">--}}

{{--        @include('adminlte-templates::common.errors')--}}

{{--        <div class="card">--}}
{{--            {!! Form::model($contractObjective, ['route' => ['contractObjectives.update', $contractObjective->id], 'method' => 'patch']) !!}--}}
{{--            <div class="card-body">--}}
{{--                <div class="row">--}}
{{--                    @include('contract_objectives.fields')--}}
{{--                </div>--}}
{{--            </div>--}}

{{--            <div class="card-footer">--}}
{{--                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}--}}
{{--                <a href="{{ route('contractObjectives.index') }}" class="btn btn-default">Cancel</a>--}}
{{--            </div>--}}

{{--            {!! Form::close() !!}--}}

{{--        </div>--}}
{{--    </div>--}}
{{--@endsection--}}
