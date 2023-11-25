@extends('layouts.master')
@section('title', 'Add contract notice')
@section('content')
    @component('components.breadcrumb')
        @slot('sub_title')
            Contracts
        @endslot
        @slot('action')
            Notices
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
                @include('contract_notices.table', ['contractNotices' => $contract->contractNotices])
                {!! Form::open(['route' => 'contractNotices.store','files' => true, 'enctype' => 'multipart/form-data']) !!}
                <div class="card-body">
                    <div class="row">
                        @include('contract_notices.fields')
                    </div>

                </div>

                <div class="card-footer text-end">
                    @if(count($contract->contractNotices) > 0)
                        <a href="{{ route('contractss.show',[encode($contract->id)]) }}" class="btn btn-default">Cancel</a>
                    @else
                        <a href="{{ route('contractss.index') }}" class="">Skip</a>
                    @endif
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                    @if(count($contract->contractNotices) > 0)
                        <a href="{{ route('contractOperationAreas.create') }}" class="btn btn-success">Finish</a>
                    @endif
                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection
