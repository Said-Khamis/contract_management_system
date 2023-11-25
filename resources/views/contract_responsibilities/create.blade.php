@extends('layouts.master')

@section('title', 'Assign contract responsibilities')
@section('content')
    @component('components.breadcrumb')
        @slot('sub_title')
            Contracts
        @endslot
        @slot('action')
            Responsibility
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
                @include('contract_responsibilities.table', ['contractResponsibilities' => $contract->contractResponsibilities])
                {!! Form::open(['route' => 'contractResponsibilities.store']) !!}
                <div class="card-body">
                    <div class="row">
                        @include('contract_responsibilities.fields')
                    </div>
                </div>
                <div class="card-footer text-end">
                    @if(count($contract->contractResponsibilities) > 0)
                        <a href="{{ route('contractss.show',encode($contract->id)) }}" class="btn btn-default">Cancel</a>
                    @else
                        <a href="{{ route('contractss.show',encode($contract->id)) }}" class="">Skip</a>
                    @endif
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                        @if(count($contract->contractResponsibilities) > 0)
                            <a href="{{ route('contractss.show',encode($contract->id)) }}" class="btn btn-success">Finish</a>
                        @endif
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
