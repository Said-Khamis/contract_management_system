<div id="addStatusModal" class="modal fade zoomIn " data-bs-backdrop="static" tabindex="-1" aria-labelledby="flipModalLabel" aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="flipModalLabel">Add Implementation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
               <form id="formImplementation need-validation">
                   <div class="col">
                        @include("implementation_statuses.fields")
                   </div>
               </form>
            </div>

        </div>
    </div>
</div>
