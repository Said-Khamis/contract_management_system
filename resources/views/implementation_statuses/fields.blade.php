<div class="form-group">
    <label for="percent">Percent Reached (%)</label>
    <input id="percent" class="form-control" type="number" name="percent" placeholder="Percent (%)">
    <span class="error_percent text-danger">Percent is required field</span>
</div>
<input type="hidden" name="contractId" id="contractId" value="{{ $dataArrayImplementations["contract_id"] }}">
<div class="form-group mt-3">
    <label for="comments">Comment (s)</label>
    <textarea class="comments" id="comments" name="comments"></textarea>
    <span class="error_comments text-danger">Comment (s) is required field</span>
</div>

<div class="form-group mt-3 d-flex flex-row-reverse">
    <button type="button" class="btn btn-primary " id="saveBtn">Save Changes</button>
    <button class="btn btn-primary" type="button" disabled id="savingBtn">
        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
        Saving...
    </button>
    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
</div>
