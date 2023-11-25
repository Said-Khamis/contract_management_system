<div class="card">
    <div class="card-header">
        Agreement Objectives
        <a class="btn btn-primary btn-sm float-end" href="{{route('contractObjectives.create')}}">+</a>
    </div>
    @include('contract_objectives.table', ['contractObjectives' => $contract->contractObjectives])
</div>
