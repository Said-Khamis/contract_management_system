@extends('layouts.master')
@section('title', 'Add Action Plans')
@section('content')
    @component('components.breadcrumb')
        @slot('sub_title')
            Contracts
        @endslot
        @slot('action')
            Action Plans
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
                @include('contract_action_plans.table', ['contractActionPlans' => $contract->actionPlans])
                {!! Form::open(['route' => 'contractActionPlans.store', 'enctype' => 'multipart/form-data']) !!}
                <div class="card-body">
                    <div class="row">
                        @if($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        @include('contract_action_plans.fields')
                    </div>
                </div>
                <div class="card-footer text-end">
                    @if(count($contract->actionPlans) > 0)
                        <a href="{{ route('contractss.show',[encode($contract->id)]) }}" class="btn btn-default">Cancel</a>
                    @else
                        <a href="{{ route('contractss.show', encode($contract->id)) }}" class="">Skip</a>
                    @endif
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    @if(count($contract->actionPlans) > 0)
                        <a href="{{ route('contractActionPlans.create') }}" class="btn btn-success">Finish</a>
                    @endif
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection
