<!-- Varying modal content -->
<div class="modal fade" id="designationModal" tabindex="-1" data-bs-backdrop="static" aria-labelledby="departLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="departLabel">Add Department</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formDesignation" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <input type="hidden" name="designId"/>
                    <div class="row">
                        @include("designations.fields")
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
                            <td>Title</td>
                            <td id="title"></td>
                        </tr>
                        <tr>
                            <td>Description</td>
                            <td id="desc"></td>
                        </tr>
                        <tr>
                            <td>Institution</td>
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
