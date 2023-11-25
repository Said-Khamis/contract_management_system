<div class="row">
    <div class="col">
        @include('contracts._parties')
        <!-- Add iframe for PDF display -->
        <div class="pdf-container mb-4">
            @if($contract->attachments()->where('name','agreement')->first())
                <iframe src="{{asset($contract->attachments()->where('name','agreement')->first()?->url)}}" frameborder="0" width="100%" height="100%"></iframe>
            @endif
        </div>
{{--        @include('contractss._notices')--}}
    </div>
    <div class="col">
{{--        @include('contractss._delivery')--}}
        @include('contracts._sectors')
        @include('contracts._objectives')
        @include('contracts._responsibilities')
        @include('contracts._cooperation_area')
        @include('contracts._action_plan')
    </div>
</div>
