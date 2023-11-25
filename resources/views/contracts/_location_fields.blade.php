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
    {!! Form::label('district_id', 'District:') !!}
{{--    {!! Form::select('district_id', ['' => ''], null, ['class' => 'form-control custom-select']) !!}--}}
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
            <option value="{{$key}}"{{ isset($contract->signedLocation->district_id) && $key == $contract->signedLocation->district_id ? 'selected' : '' }}>
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
