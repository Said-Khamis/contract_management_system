<!-- Varying modal content -->
<div class="modal fade" id="institutionModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="instLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="instLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formInstitution" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="institutionId"/>
                    <div class="row">
                        @include("institutions.fields")
                    </div>
                    <div class="text-end mt-3">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>

                <div id="formShowDetails">
                    <table class="table table-striped align-middle mb-0">
                        <tbody>
                           <tr>
                               <td>Name</td>
                               <td id="name"></td>
                           </tr>
                           <tr>
                               <td>Abbreviation</td>
                               <td id="desc"></td>
                           </tr>
                           <tr>
                               <td>Institution (Parent)</td>
                               <td id="institution"></td>
                           </tr>
                           <tr>
                               <td>Date Added</td>
                               <td id="date_added"></td>
                           </tr>
                           <tr>
                               <td>Last modified</td>
                               <td id="date_modified"></td>
                           </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
