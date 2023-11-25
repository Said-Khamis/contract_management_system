<div class="card">
    <div class="card-header">
        Areas of Cooperation
        <a class="btn btn-primary btn-sm float-end" href="{{route('contractOperationAreas.create')}}">+</a>
    </div>
    @include('contract_operation_areas.on_contract_show_table', ['contractOperationAreas' => $contract->contractOperationAreas])
</div>
