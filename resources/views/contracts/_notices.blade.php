<div class="card">
    <div class="card-header">
        Agreement Notices
        <a class="btn btn-primary btn-sm float-end" href="{{route('contractNotices.create')}}">+</a>
    </div>
    @include('contract_notices.table', ['contractNotices' => $contract->contractNotices])
</div>
