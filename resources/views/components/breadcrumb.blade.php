<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0 font-size-18">@yield('title')</h4>

            <div class="page-title-right">
            <ol class="breadcrumb m-0">
                    @if(isset($sub_title))
                    <li class="breadcrumb-item"><a href="javascript: void(0);">{{ $sub_title }}</a></li>
                        <li class="breadcrumb-item active">{{ $action }}</li>
                    @endif
                </ol>
            </div>
        </div>
    </div>
</div>
<!-- end page title -->


<!-- modal section -->
<div class="modal fade" data-bs-backdrop="static" id="varyingContentModal" tabindex="-1" aria-labelledby="varyingcontentModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <h5 class="modal-title" id="varyingcontentModalLabel">New message</h5> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-contents"></div>
            </div>
        </div>
    </div>
</div>
