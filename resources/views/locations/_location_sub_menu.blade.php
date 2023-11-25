<div class="row mb-2">
    <div class="col text-end">
        <a href="{{ route('countries.index') }}" class="btn {{Request::is('settings/locations/countries') ? 'btn-soft-primary btn-border' : 'btn-light shadow-sm' }}">Countries</a>
        <a href="{{ route('states.index') }}" class="btn {{Request::is('settings/locations/states') ? 'btn-soft-primary btn-border' : 'btn-light shadow-sm' }}">States</a>
        <a href="{{ route('regions.index') }}" class="btn {{Request::is('settings/locations/regions') ? 'btn-soft-primary btn-border' : 'btn-light shadow-sm' }}">Regions</a>
        <a href="{{ route('districts.index') }}" class="btn {{Request::is('settings/locations/districts') ? 'btn-soft-primary btn-border' : 'btn-light shadow-sm' }}">Districts</a>
        <a href="{{ route('wards.index') }}" class="btn {{Request::is('settings/locations/wards') ? 'btn-soft-primary btn-border' : 'btn-light shadow-sm' }}">Wards</a>
        <a href="{{ route('cities.index') }}" class="btn {{Request::is('settings/locations/cities') ? 'btn-soft-primary btn-border' : 'btn-light shadow-sm' }}">Cities</a>
    @if(Request::is('countries'))
{{--            <a href="{{route('countries.create')}}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#countryCreate">--}}
{{--                <i class="ri-add-fill"></i> New Country--}}
{{--            </a>--}}
            <button type="button" class="btn btn-primary data-modal" data-url="{{route('countries.create')}}"><i class="ri-add-fill"></i> New Country</button>
        @endif
        @if(Request::is('regions'))
            <button type="button" class="btn btn-primary data-modal" data-url="{{route('regions.create')}}"><i class="ri-add-fill"></i> New Region</button>

{{--            <a href="javascript:void(0)" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#regionCreate">--}}
{{--                <i class="ri-add-fill"></i> New Region--}}
{{--            </a>--}}
        @endif
        @if(Request::is('districts'))
            <button type="button" class="btn btn-primary data-modal" data-url="{{route('districts.create')}}"><i class="ri-add-fill"></i> New District</button>

{{--            <a href="{{route('districts.create')}}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#districtCreate">--}}
{{--                <i class="ri-add-fill"></i> New District--}}
{{--            </a>--}}
        @endif
        @if(Request::is('wards'))
            <button type="button" class="btn btn-primary data-modal" data-url="{{route('wards.create')}}"><i class="ri-add-fill"></i> New Ward</button>

{{--            <a href="{{route('wards.create')}}" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#wardCreate">--}}
{{--                <i class="ri-add-fill"></i> New Ward--}}
{{--            </a>--}}
        @endif
        @if(Request::is('cities'))
            <button type="button" class="btn btn-primary data-modal" data-url="{{route('cities.create')}}"><i class="ri-add-fill"></i> New City</button>
        @endif
        @if(Request::is('states'))
            <button type="button" class="btn btn-primary data-modal" data-url="{{route('states.create')}}"><i class="ri-add-fill"></i> New State</button>
        @endif
    </div>
</div>
