{{--show--}}
<div class="modal fade" id="showModal{{ $city->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header  p-3">
                <h5 class="modal-title" id="exampleModalLabel">Show cities</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <hr>

                <div class="modal-body">
                    <input type="hidden" id="id-field" />
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div>
                                <label for="industry_type-field" class="form-label">Country</label>
                                <select class="form-select" id="industry_type-field" disabled name="country_id" readonly="">
                                    @foreach(getPluckedCountry() as $id => $name)
                                        <option value="{{ $id }}" {{ $id == $city->country_id ? 'selected' : '' }}>{{ $name }}</option>
                                    @endforeach
                                </select>


                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="companyname-field" class="form-label">Name</label>
                                    <input type="text" id="companyname-field" name="name" value="{{ $city->name }}" disabled class="form-control" placeholder="Enter Name" required />
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
        </div>
    </div>
</div>

{{--edit--}}
<div class="modal fade" id="editModal{{ $city->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content border-0">
            <div class="modal-header  p-3">
                <h5 class="modal-title" id="exampleModalLabel">Edit cities</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
            </div>
            <hr>
            <form class="tablelist-form" action="{{ route('cities.update',$city['id']) }}" method="POST" autocomplete="off">
                @method('PUT')
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="id-field" />
                    <div class="row g-3">
                        <div class="col-lg-6">
                            <div>
                                <label for="industry_type-field" class="form-label">Country</label>
                                <select class="form-select" id="industry_type-field" name="country_id">
                                    @foreach(getPluckedCountry() as $id => $name)
{{--                                        <option value="{{ $id }}">{{ $name }}</option>--}}
                                        <option value="{{ $id }}" {{ $id == $city->country_id ? 'selected' : '' }}>{{ $name }}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div>
                                <label for="companyname-field" class="form-label">Name</label>
                                @isset($city)
                                    <input type="text" id="companyname-field" name="name" value="{{ $city->name }}" class="form-control" placeholder="Enter Name" required />

                                @else
                                    <input type="text" id="companyname-field" name="name" value="" class="form-control" placeholder="Enter Name" required />

                                @endisset
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="hstack gap-2 justify-content-end">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="add-btn">Save</button>
                        <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--end add modal-->
