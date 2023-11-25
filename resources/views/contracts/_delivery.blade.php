<div class="card">
    <div class="card-header">
        Delivery Timeline
        <a class="btn btn-primary btn-sm float-end" href="{{route('contractDeliveries.create')}}">+</a>
    </div>
    @include('contract_delivery.table', ['contractDeliveries' => $contract->contractDelivery])
</div>
