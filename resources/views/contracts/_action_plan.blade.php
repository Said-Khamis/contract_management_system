<div class="card">
    <div class="card-header">
        Contract Action Plans
        <a class="btn btn-primary btn-sm float-end" href="{{route('contractActionPlans.create')}}">+</a>
    </div>
    @include('contract_action_plans.table', ['contractActionPlans' => $contract->actionPlans])
</div>
