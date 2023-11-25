@extends('layouts.master')
@section('title', 'Add Areas of Cooperation')
@section('content')
    @component('components.breadcrumb')
        @slot('sub_title')
            Contracts
        @endslot
        @slot('action')
            Areas of Cooperation
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
                @include('contract_operation_areas.table', ['contractOperationAreas' => $contract->contractOperationAreas])
                {!! Form::open(['route' => 'contractOperationAreas.store']) !!}
                <div class="card-body">
                    <div class="row">
                        @include('contract_operation_areas.fields')
                    </div>

                </div>

                <div class="card-footer text-end">
                    @if(count($contract->contractOperationAreas) > 0)
                        <a href="{{ route('contractss.show',[encode($contract->id)]) }}" class="btn btn-default">Cancel</a>
                    @else
                        <a href="{{ route('contractResponsibilities.create') }}" class="">Skip</a>
                    @endif
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    @if(count($contract->contractOperationAreas) > 0)
                        <a href="{{ route('contractResponsibilities.create') }}" class="btn btn-success">Finish</a>
                    @endif
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection
