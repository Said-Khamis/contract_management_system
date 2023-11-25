<div>
    <div class="row">
        <!-- Type Field -->
        <div class="form-group col-sm-6 mb-3">
            {!! Form::label('type', 'Contract Type:',['class' => 'mb-0']) !!}
            <select name="type"  id="" disabled class="form-control {{validateInput($errors, 'type', $type)}}">
                <option value="">Choose contract type</option>
                @foreach(config('data.contract_types') as $type)
                    <option value="{{$type}}" {{ $type==$contract->type ? 'selected' :'' }}>{{$type}}</option>
                @endforeach
            </select>
            @error('type')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror

        </div>
    <!-- Category Field -->
    <div class="form-group col-sm-6 mb-3">
        <label for="category_id" class="mb-0">Category:
        </label>
        @if ($contract->type === 'Bilateral Agreement' || $contract->type === 'Memorandum Of Understanding')
            <select id="category_id" class="form-select @error('category_id') is-invalid @enderror" name="category_id" required aria-label="Default select example">
                <option value="" selected>Please Select Category</option>
                @foreach(getPluckedCategory()->forget(1)->all() as $key => $value)
                    <option value="{{ $key }}" {{($contract->category->id==$key)?'selected':''}}>{{ $value }}</option>
                @endforeach
            </select>
        @else
            <input title="Not allowed" type="text" style="cursor:not-allowed;" readonly class="form-control"
                   name="category_id" value="" onmouseover="this.style.backgroundColor='#e3e3e3'"
                   onmouseout="this.style.backgroundColor='transparent'">
        @endif
    </div>

        <!-- Title Field -->
        <div class="form-group col-sm-6 mb-3">
            <label class="form-label"> Title</label>
            <input type="text"  name="title" value="{{ $contract->title }}" class = "form-control">
            @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <!-- Reference No Field -->
        <div class="form-group col-sm-6 mb-3">
            <label class="form-label">Reference no</label>
            <input type="text"  value="{{ $contract->reference_no }}" name="reference_no" class = "form-control">
            @error('reference_no')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        @if ($contract->type !== 'Multilateral Agreement')

        <div class="col-12">
            <label>BETWEEN</label>
            <hr class="m-0">
            <!-- Institution Field -->
            <div class="row mt-3">
                <div class="form-group col-sm-6 mb-3">
                    <label for="institution_id" class="mb-0">Home Parties:</label>
                    <select name="home_institution_id" id="institution_id" class="form-control">
                        @foreach (getHomePartiesPluckednstitutions()->forget(0)->all() as $key => $value) {
                         <option value="{{$key }}" {{ $key == getContractPartInstitutionIds($contract)['homePartInstitutionId'] ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                    @error('institution_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                <!-- Institution Field -->
                <div class="form-group col-sm-6 mb-3">
                    <label for="institution_id" class="mb-0">Home Parties:</label>
                    <select name="foreign_institution_id" id="institution_id" class="form-control">
                        @foreach (getForeignPartiesPluckedInstitutions()->forget(0)->all() as $key => $value) {
                        <option value="{{$key }}" {{ $key == getContractPartInstitutionIds($contract)['foreignPartInstitutionId'] ? 'selected' : '' }}>{{ $value }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        @endif
        <!-- Start Date Field -->
        <div class="form-group col-sm-6 mb-3">
            {!! Form::label('start_date', 'Start Date:',['class' => 'mb-0']) !!}
            @if($contract->start_date)
                <input type="date" name="start_date" value="{{ date('Y-m-d', strtotime($contract->start_date)) }}" class="form-control">
            @else
                <input type="date" name="start_date" value="" class="form-control">
            @endif
            @error('start_date')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        @if ($contract->type !== 'Multilateral Agreement')

        <!-- End Date Field -->
        <div class="form-group col-sm-6 mb-3">
            {!! Form::label('end_date', 'End Date:',['class' => 'mb-0']) !!}
            @if($contract->start_date)
                <input type="date" name="end_date" value="{{ date('Y-m-d', strtotime($contract->end_date)) }}" class="form-control">
            @else
                <input type="date" name="end_date" value="" class="form-control">
            @endif
            @error('end_date')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <!-- Duration Field -->
        <div class="form-group col-sm-6 mb-3">
            <label for="duration" class="mb-0">Duration:</label>
            <input type="number" name="duration" id="duration"  class="form-control" value="{{ $contract->duration }}">
        </div>
        @endif

        <!-- Attachment Field -->
        <div class="form-group col-sm-6 mb-3">

            <livewire:attachment-container :name="'Additional'" />
            <div>
                <table class="table">
                    <thead>
                    <tr>
                        <th>Title</th>
                        <th width="100">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach (getContractAttachment($contract->id) as $attachment)
                        <tr>
                            <td>
                                @if (str_contains($attachment->url, 'letter_of_intent'))
                                    Title: Letter of Intent
                                @elseif (str_contains($attachment->url, 'passport_copy'))
                                    Title: Instrument of Ratification
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('attachment.preview',encode($attachment->id)) }}" class="btn btn-sm btn-primary">
                                    <span class="tf-icons bx bx-file me-1"></span>
                                </a>
                                <a href="{{ url('attachment',encode($attachment->id)) }}" class="btn btn-sm btn-danger">
                                    <span class="tf-icons bx bx-trash me-1"></span>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!--  Field -->
        <div class="form-group  col-sm-6 mb-3">
            <div class="row">
                {{-- signed check --}}
                @if ($contract->signed_at !== null)
                    <div class="col">
                        {!! Form::label('is_signed', 'Signed ?', ['class' => 'form-check-label mb-0']) !!}
                        <label class="form-check">
                            <input type="checkbox" disabled class="form-check-input" name="some_checkbox" @if($contract->signed_at) checked @endif>
                        </label>
                    </div>
                @else
                    <div class="col">
                        {!! Form::label('is_signed', 'Signed ?', ['class' => 'form-check-label mb-0']) !!}
                        <label class="form-check">
                            <input type="checkbox"  name="isSigned"  readonly class="form-check-input" wire:click="toggleSignedFields" id="isSigned">
                        </label>
                    </div>
                @endif

                 {{-- ratified check --}}
                @if ($contract->ratified_at !== null)
                    <div class="col">
                        {!! Form::label('isRatified', 'Ratified ?', ['class' => 'form-check-label mb-0']) !!}
                        <label class="form-check">
                            <input type="checkbox" disabled class="form-check-input" name="some_checkbox" @if($contract->ratified_at) checked @endif>
                        </label>
                    </div>
                @else
                    <div class="col">
                        {!! Form::label('isRatified', 'Ratified ?', ['class' => 'form-check-label mb-0']) !!}
                        <label class="form-check">
                            <input type="checkbox"  name="isRatified"  readonly class="form-check-input" wire:click="toggleRatifiedFields" id="isRatified">
                        </label>
                    </div>
                @endif
{{--                <div class="col">--}}
{{--                    {!! Form::label('amended', 'Amended ?', ['class' => 'form-check-label mb-0']) !!}--}}
{{--                    <label class="form-check">--}}
{{--                        <input type="checkbox" wire:model="amended" name="amended" class="form-check-input">--}}
{{--                    </label>--}}
{{--                </div>--}}
            </div>
        </div>

        @if($contract->signed_at !==null)
            <div class="form-group col-sm-6 mb-3">
                {!! Form::label('signed_at', 'Signed Date:', ['class' => 'mb-0']) !!}
                <div class="input-group">
                    <input type="date" name="signed_at"  value="{{ date('Y-m-d', strtotime($contract->signed_at)) }}" class="form-control input-group-sm">
                </div>
            </div>

            <!-- Signed Place Field -->
            <div class="form-group col-sm-6 mb-3">
                <label>Signed Location:</label>
                <hr class="m-0">
                <div class="row">

{{--                                        @include('contractss._location_fields',['contract'=>$contract])--}}
                    <!-- Region Id Field -->
                    <div class="form-group col-sm-6 text-capitalize">
                        {!! Form::label('country_id', 'Country:') !!}
                        <select name="country_id" class="form-control">
                            <option value="">Choose country </option>
                            @foreach(getPluckedCountry() as $key => $value)
                                <option value="{{ $key }}" {{ isset($contract->signedLocation->country_id) && $key == $contract->signedLocation->country_id ? 'selected' : '' }}>
                                    {{ $value }}
                                </option>
                            @endforeach

                        </select>
                    </div>
                    @if($hasRegions)
                        <!-- Region Id Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('region_id', 'Region:') !!}
                            <select name="region_id" class="form-control">
                                <option value="">Choose region     </option>
                                @foreach(getPluckedRegion($country_id) as $key => $value)
                                    <option value="{{$key}}" {{ $key == $contract->signedLocation->region_id  ? 'selected' : '' }}>{{Str::of($value)->ucfirst()}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    @if($hasCity)
                        <!-- City Id Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('city_id', 'City:') !!}
                            <select name="city_id"  class="form-control">
                                <option value="">Choose city</option>
                                @foreach(getPluckedCity($country_id) as $key => $value)
                                    <option value="{{$key}}"{{ $key == $contract->signedLocation->district_id  ? 'selected' : '' }}>{{Str::of($value)->ucfirst()}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    @if($hasState)
                        <!-- State Id Field -->
                        <div class="form-group col-sm-6">
                            {!! Form::label('state_id', 'State:') !!}
                            {{--        {!! Form::select('state_id', ['' => ''], null, ['class' => 'form-control custom-select']) !!}--}}
                            <select name="state_id" wire:model="state_id" class="form-control">
                                <option value="">Choose state</option>
                                @foreach(getPluckedState($country_id) as $key => $value)
                                    <option value="{{$key}}">{{Str::of($value)->ucfirst()}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <!-- District Id Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('district_id', 'District:') !!}
                        <select name="district_id" class="form-control">
                            <option value="">Choose district</option>
                            @foreach(getPluckedDistrict($region_id) as $key => $value)
                                <option value="{{$key}}"{{ isset($contract->signedLocation->district_id) && $key == $contract->signedLocation->district_id ? 'selected' : '' }}>
                                    {{ Str::of($value)->ucfirst() }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Ward Id Field -->
                    <div class="form-group col-sm-6">
                        {!! Form::label('ward_id', 'Ward:') !!}
                        {{--    {!! Form::select('ward_id', ['' => ''], null, ['class' => 'form-control custom-select']) !!}--}}
                        <select name="ward_id"  class="form-control">
                            <option value="">Choose ward</option>
                            @foreach(getPluckedWard($district_id) as $key => $value)
                                <option value="{{$key}}"{{ isset($contract->signedLocation->ward_id) && $key == $contract->signedLocation->ward_id ? 'selected' : '' }}>
                                    {{ Str::of($value)->ucfirst() }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Settlement Field -->
                    <div class="form-group col-sm-6">
                        <label for="settlement">Settlement:</label>
                        <input type="text" name="settlement" value="{{ $contract->signedLocation ? $contract->signedLocation->settlement : '' }}" id="settlement" class="form-control">
                    </div>

                </div>
            </div>
        @else
            @if ($showSignedFields)
                <div class="form-group col-sm-6 mb-3">
{{--                    {!! Form::label('signed_at', 'Signed Date:', ['class' => 'mb-0']) !!}--}}
                    <div class="input-group">
                        <input type="date" name="signed_at" required  value="" class="form-control input-group-sm">
                    </div>
                </div>
                <!-- Signed Place Field -->
                <div class="form-group col-sm-6 mb-3">
                    <label>Signed Location:</label>
                    <hr class="m-0">
                    <div class="row">
                        <!-- Region Id Field -->
                        <div class="form-group col-sm-6 text-capitalize">
                            {!! Form::label('country_id', 'Country:') !!}
                            <select name="country_id" class="form-control">
                                <option value="">Choose country </option>

                                @foreach(getPluckedCountry() as $key => $value)
                                    <option value="{{ $key }}" {{ isset($contract->signedLocation->country_id) && $key == $contract->signedLocation->country_id ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach

                            </select>
                        </div>
                        @if($hasRegions)
                            <!-- Region Id Field -->
                            <div class="form-group col-sm-6">
                                {!! Form::label('region_id', 'Region:') !!}
                                <select name="region_id" class="form-control">
                                    <option value="">Choose region     </option>
                                    @foreach(getPluckedRegion($country_id) as $key => $value)
                                        <option value="{{$key}}" {{ $key == $contract->signedLocation->region_id  ? 'selected' : '' }}>{{Str::of($value)->ucfirst()}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif
                        @if($hasCity)
                            <!-- City Id Field -->
                            <div class="form-group col-sm-6">
                                {!! Form::label('city_id', 'City:') !!}
                                {{--        {!! Form::select('city_id', ['' => ''], null, ['class' => 'form-control custom-select']) !!}--}}
                                <select name="city_id"  class="form-control">
                                    <option value="">Choose city</option>
                                    @foreach(getPluckedCity($country_id) as $key => $value)
                                        <option value="{{$key}}"{{ $key == $contract->signedLocation->district_id  ? 'selected' : '' }}>{{Str::of($value)->ucfirst()}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        @if($hasState)
                            <!-- State Id Field -->
                            <div class="form-group col-sm-6">
                                {!! Form::label('state_id', 'State:') !!}
                                {{--        {!! Form::select('state_id', ['' => ''], null, ['class' => 'form-control custom-select']) !!}--}}
                                <select name="state_id" wire:model="state_id" class="form-control">
                                    <option value="">Choose state</option>
                                    @foreach(getPluckedState($country_id) as $key => $value)
                                        <option value="{{$key}}">{{Str::of($value)->ucfirst()}}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <!-- District Id Field -->
                        <div class="form-group col-sm-6">
                            <label for="district_id">District:</label>
                            <select wire:model="district_id" name="district_id" class="form-control">
                                <option value="">Choose district</option>
                                @foreach(getPluckedDistrict($region_id) as $key => $value)
                                    <option value="{{ $key }}">
                                        {{ Str::of($value)->ucfirst() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Ward Id Field -->
                        <div class="form-group col-sm-6">
                            <label for="ward_id">Ward:</label>
                            <select wire:model="ward_id" name="ward_id" class="form-control">
                                <option value="">Choose ward</option>
                                @foreach($wards as $key => $value)
                                    <option value="{{ $key }}">
                                        {{ Str::of($value)->ucfirst() }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

{{--                        <!-- District Id Field -->--}}
{{--                        <div class="form-group col-sm-6">--}}
{{--                            {!! Form::label('district_id', 'District:') !!}--}}
{{--                            --}}{{--    {!! Form::select('district_id', ['' => ''], null, ['class' => 'form-control custom-select']) !!}--}}
{{--                            <select name="district_id" id="dd" class="form-control">--}}
{{--                                <option value="">Choose district</option>--}}
{{--                                @foreach(getPluckedDistrict($region_id) as $key => $value)--}}
{{--                                    <option value="{{$key}}"{{ isset($contract->signedLocation->district_id) && $key == $contract->signedLocation->district_id ? 'selected' : '' }}>--}}
{{--                                        {{ Str::of($value)->ucfirst() }}--}}
{{--                                    </option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}

{{--                        <!-- Ward Id Field -->--}}
{{--                        <div class="form-group col-sm-6">--}}
{{--                            {!! Form::label('ward_id', 'Ward:') !!}--}}
{{--                            <select name="ward_id"  class="form-control">--}}
{{--                                <option value="">Choose ward</option>--}}
{{--                                @foreach(getPluckedWard($district_id) as $key => $value)--}}
{{--                                    <option value="{{$key}}"{{ isset($contract->signedLocation->ward_id) && $key == $contract->signedLocation->ward_id ? 'selected' : '' }}>--}}
{{--                                        {{ Str::of($value)->ucfirst() }}--}}
{{--                                    </option>--}}
{{--                                @endforeach--}}
{{--                            </select>--}}
{{--                        </div>--}}

                        <!-- Settlement Field -->
                        <div class="form-group col-sm-6">
                            <label for="settlement">Settlement:</label>
                            <input type="text" name="settlement" value="{{ $contract->signedLocation ? $contract->signedLocation->settlement : '' }}" id="settlement" class="form-control">
                        </div>
                    </div>
                </div>
            @endif
        @endif
           {{--  ratified date        --}}
        @if($contract->ratified_at !==null)
            <div class="form-group col-sm-6 mb-3">
                    {!! Form::label('ratified_at', 'Ratification Date:', ['class' => 'mb-0']) !!}
                <div class="input-group">
                    <input type="date" name="ratified_at"  value="{{ date('Y-m-d', strtotime($contract->ratified_at)) }}" class="form-control input-group-sm">
                </div>
            </div>
        @else
            @if ($showRatifiedFields)
                <div class="form-group col-sm-6 mb-3">
                    {!! Form::label('ratified_at', 'Ratification Date:', ['class' => 'mb-0']) !!}
                    <div class="input-group">
                        <input type="date" name="ratified_at" required  value="" class="form-control input-group-sm">
                    </div>
                </div>
            @endif
        @endif
    </div>
</div>
