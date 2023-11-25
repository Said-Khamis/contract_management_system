@extends('layouts.master')
@section('title', 'Agreements Management')
@section('content')
    @component('components.breadcrumb')
        @slot('sub_title')
            Agreements
        @endslot
        @slot('action')
            Create
        @endslot
    @endcomponent
    @include('contracts._contract_sub_menu')
    <div class="content">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Create New Agreement</h4>
            </div>

            {!! Form::open(['route' => 'contractss.store', 'files' => true, 'enctype' => 'multipart/form-data']) !!}

            <div class="card-body">

                <div class="row">
                    @include('contracts.fields')
                </div>

            </div>

            <div class="card-footer text-end">
                <a href="{{ route('contractss.index') }}" class="btn btn-default">Cancel</a>
                {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection

@section('script')
    <script type="text/javascript">
        var startDateInput = document.getElementById('start_date');
        var endDateInput = document.getElementById('end_date');

        endDateInput.addEventListener('change', function () {
            if (endDateInput.value <= startDateInput.value) {
                alert('The start date should not be after or equal the end date.');
                endDateInput.value = '';
            }
        });
    </script>
@endsection
