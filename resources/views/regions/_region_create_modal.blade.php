
<!-- staticBackdrop Modal -->
<div class="modal fade" id="regionCreate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" style="margin-left: 1.8em;" id="role-permission-update">Add new region</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{route('regions.store')}}" method="post">
                @csrf
                <div class="modal-body text-center p-5">
                    <div class="row">
                        @include('regions.fields')
                    </div>

                    <div class="mt-4">
                        <div class="hstack gap-2 justify-content-end">
                            <a href="javascript:void(0);" class="btn btn-link link-success fw-medium" data-bs-dismiss="modal"><i class="ri-close-line me-1 align-middle"></i> Close</a>
                            {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

