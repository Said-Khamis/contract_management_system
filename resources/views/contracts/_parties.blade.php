<div class="card">
    <div class="card-header">
        Agreement Parties
    </div>
    @include('contract_parties.table', ['contractParties' => $contract->contractParties])
</div>
