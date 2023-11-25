@extends('layouts.master')

@section('title', 'Assign contract objectives')
@section('content')
    @component('components.breadcrumb')
        @slot('sub_title')
            Contracts
        @endslot
        @slot('action')
            Objectives
        @endslot
    @endcomponent
    <div class="row">
        <div class="col">

            <div class="card">
                <div class="card-header">
                    Contract Details
                </div>
                @include('contracts.show_fields')
            </div>

            <div class="card">
                <div class="card-header">
                   <b>Objective</b>
                </div>

                @include('contract_objectives.table', ['contractObjectives' => $contract->contractObjectives])
                {!! Form::open(['route' => 'contractObjectives.store']) !!}
                <div class="card-body">
                    <div class="row">
                        @include('contract_objectives.fields')
                    </div>

                </div>

                <div class="card-footer text-end">
                    @if(count($contract->contractObjectives) > 0)
                        <a href="{{ route('contractss.show',encode($contract->id)) }}" class="btn btn-default">Cancel</a>
                    @else
                        <a href="{{ route('contractOperationAreas.create') }}" class="">Skip</a>
                    @endif
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    @if(count($contract->contractObjectives) > 0)
                        <a href="{{ route('contractOperationAreas.create') }}" class="btn btn-success">Finish</a>
                    @endif
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection
