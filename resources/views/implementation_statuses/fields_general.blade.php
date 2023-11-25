<div class="form-group">
    <label for="area">Implemented Area</label>
    <textarea id="area" class="form-control" name="area" placeholder="What have done?"></textarea>
    <span class="error_area text-danger"></span>
</div>
<input type="hidden" name="contractId" id="contractId" value="{{ $dataArrayImplementations["contract_id"] }}">
<div class="form-group mt-3 d-flex flex-row-reverse">
    <button type="button" class="btn btn-primary " id="saveBtnGeneral">Save</button>
    <button class="btn btn-primary" type="button" disabled id="savingBtnGeneral">
        <span class="spinner-grow spinner-grow-sm" role="status" aria-hidden="true"></span>
        Saving...
    </button>
    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
</div>
