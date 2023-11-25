@extends('layouts.master')
@section('title', 'Add Timeline Delivery')
@section('content')
    @component('components.breadcrumb')
        @slot('sub_title')
            Contracts
        @endslot
        @slot('action')
           Contract Deliveries
        @endslot
    @endcomponent
    <div class="row">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    Contract Timeline Delivery Details
                </div>
                @include('contracts.show_fields')
            </div>
            <div class="card">
                @include('contract_delivery.table', ['contractDeliveries' => $contract->contractDelivery])
                {!! Form::open(['route' => 'contractDeliveries.store']) !!}
                <div class="card-body">
                    <div class="row">
                        @include('contract_delivery.fields')
                    </div>
                </div>
                <div class="card-footer text-end">
                    @if(count($contract->contractDelivery) > 0)
                        <a href="{{ route('contractss.show',[encode($contract->id)]) }}" class="btn btn-default">Cancel</a>
                    @else
                        <a href="{{ route('contractss.show', encode($contract->id)) }}" class="">Skip</a>
                    @endif
                    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}

                </div>

                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener("DOMContentLoaded", function () {
        const selectElement = document.getElementById("unit");
        const eachContent = document.querySelector(".each-content");
        const atContent = document.querySelector(".at-content");
        selectElement.addEventListener("change", function () {
            const selectedValue = selectElement.value;

            if (selectedValue === "each") {
                eachContent.style.display = "block";
                atContent.style.display = "none";
            } else if (selectedValue === "at") {
                eachContent.style.display = "none";
                atContent.style.display = "block";
            } else {
                eachContent.style.display = "none";
                atContent.style.display = "none";
            }
        });
    });
</script>
