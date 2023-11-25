<div class="card">
    <div class="card-header">
        Agreement Responsibilities
        <a class="btn btn-primary btn-sm float-end" href="{{route('contractResponsibilities.create')}}">+</a>
    </div>
    @include('contract_responsibilities.on_contract_show_table', ['contractResponsibilities' => $contract->contractResponsibilities])
</div>
