<div class="col-md-12 ps-0 mx-0">
    <div class="card p-0">
        <div class="card-header">
            <h5 class="card-title">{{$name}} Attachments</h5>
        </div>
        <div class="card-body">
            <a href="javascript:void(0)" wire:click="increment" class="btn btn-primary btn-sm rounded-pill px-2 float-end mt-3">+</a>
            <div class="row">
                @for($i = 0; $i < $count; $i++)
                    <livewire:attachment :wire:key="'attachment-form-' . $i+1"/>
                @endfor
            </div>
        </div>
    </div>
</div>
