<div class="row mb-2">
    <div class="col text-end">
        @if(Request::is('cities'))
            <a href="javascript:void(0)" class="btn btn-primary data-modal" data-bs-toggle="modal" data-url="{{ route('cities.create') }}">
                <i class=" bx bx-plus text-green"></i>&ensp; Add City
            </a>
        @endif
    </div>
</div>
