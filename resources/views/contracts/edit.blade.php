@extends('layouts.master')
@section('title', 'Agreements Management')
@section('content')
    @component('components.breadcrumb')
        @slot('sub_title')
            Agreements
        @endslot
        @slot('action')
            Edit
        @endslot
    @endcomponent
    <div class="content">
        <div class="card">
{{--            <div class="card-header">--}}
{{--                <h4 class="card-title">Edit Agreement</h4>--}}
{{--                <a href="#" class="btn btn-sm btn-outline-primary float-lg-end" onClick="window.history.back();"><i class=" bx bx-arrow-back text-green"></i>Back</a>--}}
{{----}}
{{--            </div>--}}

            <div class="card-header py-3">
                <span style="font-weight: bold; font-size: medium" class="mt-5">Edic Agreements</span>
                <a href="{{route('contractss.index')}}" class="btn btn-outline-secondary btn-sm float-end" >
                    <span class="icon-on"><i class="ri-arrow-left-line align-bottom me-1"></i> Back</span>
                </a>
            </div>

            {!! Form::model($contract, ['route' => ['contractss.update', $contract->id], 'method' => 'PUT', 'files' => true, 'enctype' => 'multipart/form-data']) !!}
            @csrf

            {{--            @if ($errors->any())--}}
{{--                <div class="alert alert-danger">--}}
{{--                    <ul>--}}
{{--                        @foreach ($errors->all() as $error)--}}
{{--                            <li>{{ $error }}</li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            @endif--}}
            <div class="card-body">
                <div>
                    <div class="row">
                        <!-- Type No Field -->
                        <div class="form-group col-sm-6 mb-3">
                            {!! Form::label('type', 'Contract Type:',['class' => 'mb-0']) !!}
                            <select name="type" id="contractType" class="form-control">
                                <option value="">Choose contract type</option>
                                @foreach(config('data.contract_types') as $type)
                                    <option value="{{$type}}"  @if($type == $contract->type) selected @endif>{{$type}}</option>
                                @endforeach
                            </select>
                            @error('type')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        @php
                            $referenceNo = $contract->reference_no;
                            preg_match('/^([^\d-]+)/', $referenceNo, $matches);
                            $nonNumericPart = $matches[1] ?? '';
                            $nonNumericParts = strtoupper($nonNumericPart);
                        @endphp
                        <div id="subcontractField" class="form-group col-sm-6 mb-3">
                            {!! Form::label('subtype', 'Contract SubType:',['class' => 'mb-0']) !!}
                            <select  name="subtype" id="contractSubType" class="form-control">
                                <option value="">Choose contract Sub type</option>
                                @foreach(getContractSubType() as $subtype)
                                    <option value="{{$subtype->name}}"  @if($subtype->name == $nonNumericParts) selected @endif>{{$subtype->name}}</option>
                                @endforeach
                            </select>
                            @error('subtype')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-sm-6">
                            <label for="title" class="mb-0">Title:</label>
                            <input type="text"  name="title" required value="{{ $contract->title }}" class = "form-control">
                            @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group col-sm-6 mb-3">
                            <label class="form-label">Reference no
                            </label>
                            <input type="text" hidden  name="prefix" id="prefixInput" value="">
                            @php
                                $referenceNo = $contract->reference_no;
                                $numericReferenceNo = preg_replace('/\D/', '', $referenceNo);
                            @endphp
                            <input type="text"  value="{{ $numericReferenceNo }}" id="reference_no_input" name="reference_no" class = "form-control">
                            @error('reference_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group col-sm-6 mb-3 regionalAgreementFields" style="display: none;">
                            {!! Form::label('category', 'Category :',['class' => 'mb-0']) !!}
                            <select name="category_id"  id="category_id" class="form-control">
{{--                                <option value="" selected>Please Select Category</option>--}}
                                @foreach(getPluckedCategory()->forget(1)->all() as $key => $value)
                                    <option value="{{ $key }}" {{ ($key == ($contract->category->id ?? null)) ? 'selected' : '' }}>{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-12  regionalAgreementFields" style="display: none;">
                            <label>BETWEEN</label>
                            <hr class="m-0">
                            <!-- Institution Field -->
                            <div class="row mt-3">
                                <div class="form-group col-sm-6 mb-3">
                                    <label for="home_institution_id" class="mb-0">Home Parties:</label>
                                    <select name="home_institution_id" id="homeInstitution" class="form-control">
                                        @foreach (getHomePartiesPluckednstitutions()->forget(0)->all() as $key => $value)
                                            <option value="{{$key }}" {{ $key == getContractPartInstitutionIds($contract)['homePartInstitutionId'] ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                    @error('home_institution_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <!-- Institution Field -->
                                <div class="form-group col-sm-6 mb-3">
                                    <label for="foreign_institution_id" class="mb-0">Foreign Parties:</label>
                                    <select name="foreign_institution_id" id="foreignInstitution" class="form-control">
                                        @foreach (getForeignPartiesPluckedInstitutions()->forget(0)->all() as $key => $value)
                                            <option value="{{$key }}" {{ $key == getContractPartInstitutionIds($contract)['foreignPartInstitutionId'] ? 'selected' : '' }}>{{ $value }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <!-- Start Date Field -->
                        <div class="form-group col-sm-6 mb-3" >
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
                        <div class="form-group col-sm-6 mb-3         regionalAgreementFields" style="display: none;">
                            {!! Form::label('end_date', 'End Date:',['class' => 'mb-0']) !!}
                            @if($contract->end_date)
                                <input type="date" name="end_date" value="{{ date('Y-m-d', strtotime($contract->end_date)) }}" class="form-control">
                            @else
                                <input type="date" name="end_date" value="" class="form-control">
                            @endif
                            @error('end_date')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>


                        <div class="form-group col-sm-12 mb-3  regionalAgreementFields" style="display: none;">
                            <label for="duration" class="mb-0">Duration: (In Years)</label>
                            <input type="number" name="duration" id="duration"  class="form-control" value="{{ $contract->duration }}">
                        </div>


                        <div class="form-group col-sm-3 mb-3">
                            {!! Form::label('is_signed', 'Signed ?', ['class' => 'form-check-label mb-0']) !!}
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input" name="signed_checkbox" id="signed_checkbox" @if($contract->signed_at) checked disabled @endif>
                            </label>
                        </div>

                        <div class="form-group col-sm-3 mb-3">
                            {!! Form::label('ratified_at', 'Ratified ?', ['class' => 'form-check-label mb-0']) !!}
                            <label class="form-check">
                                <input type="checkbox" class="form-check-input" name="ratified_checkbox" id="ratified_checkbox" @if($contract->ratified_at) checked disabled @endif>
                            </label>
                        </div>

                        <div class="form-group col-sm-3 mb-3" id="countryField" style="display: none;">
                            {!! Form::label('country_id', 'Country:') !!}
                            <select name="country_id" class="form-control">
                                <option value="">Choose Country</option>
                                @foreach(getPluckedCountry() as $key => $value)
                                    <option value="{{ $key }}" {{ isset($contract->signedLocation->country_id) && $key == $contract->signedLocation->country_id ? 'selected' : '' }}>
                                        {{ $value }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group col-sm-3 mb-3" id="regionField" style="display: none;">
                            {!! Form::label('region_id', 'Region/City/State:') !!}
                            <select name="region_id" class="form-control">
                                <option value="">Choose </option>
                                @if ($contract->signedLocation !== null)
                                    @foreach(getPluckedLocation($contract->signedLocation->country_id) as $key => $value)
                                        <option value="{{$key}}"
                                            {{($contract->signedLocation->region_id && $key == $contract->signedLocation->region_id) ||
                                            ($contract->signedLocation->state_id && $key == $contract->signedLocation->state_id) ||
                                            ($contract->signedLocation->city_id && $key == $contract->signedLocation->city_id)
                                             ? 'selected' : ''
                                              }}>
                                            {{Str::of($value)->ucfirst()}}
                                        </option>
                                    @endforeach
                                @endif
                            </select>
                        </div>

                        <div class="form-group col-sm-6 mb-3" id="signedDateField" style="display: none;">
                            {!! Form::label('signed_at', 'Signed Date:', ['class' => 'mb-0']) !!}
                            <div class="input-group">
                                <input type="date" name="signed_at" value="{{ date('Y-m-d', strtotime($contract->signed_at)) }}" class="form-control input-group-sm">
                            </div>
                        </div>

                        <div class="form-group col-sm-6 mb-3" id="ratifiedDateField" style="display: none;">
                            {!! Form::label('ratified_at', 'Ratified Date:', ['class' => 'mb-0']) !!}
                            <div class="input-group">
                                <input type="date" name="ratified_at" value="{{ date('Y-m-d', strtotime($contract->ratified_at)) }}" class="form-control input-group-sm">
                            </div>
                        </div>

                        <div class="form-group col-sm-12 mb-3 mt-2">
                            <livewire:attachment-container :name="''" />
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
                                                @if (str_contains($attachment->name, 'letter_of_intent'))
                                                    Title: Letter of Intent
                                                @elseif (str_contains($attachment->name, 'passport_copy'))
                                                    Title: Instrument of Ratification
                                                @elseif (str_contains($attachment->name, 'agreement'))
                                                    Title: Agreement
                                                @elseif (str_contains($attachment->name, 'instrument_of_ratification'))
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
                    </div>
                </div>

                {{--                    @livewire('contract-edit', ['contract' => $contract])--}}
            </div>
            <div class="card-footer text-end">
                <a href="{{ route('contractss.index') }}" class="btn btn-default">Cancel</a>
                 {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
            </div>

            {!! Form::close() !!}

        </div>
    </div>
@endsection
@section('script')
    <script>
    $(document).ready(function() {
        $('select[name="country_id"]').on('change', function() {
            var countryId = $(this).val();
            $.ajax({
                url: '/get-locations/' + countryId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    var regionSelect = $('select[name="region_id"]');
                    regionSelect.empty();
                    regionSelect.append('<option value="">Choose</option>');
                    if (data.cityData && data.cityData.length > 0) {
                        $.each(data.cityData, function(index, item) {
                            regionSelect.append('<option value="' + item.id + '">' + item.name + '</option>');
                        });
                        $('label[for="region_id"]').text('City:');

                    }else if(data.regionData && data.regionData.length > 0){
                        $.each(data.regionData, function(index, item) {
                            regionSelect.append('<option value="' + item.id + '">' + item.name + '</option>');
                        });
                        $('label[for="region_id"]').text('Region:');

                    }else if(data.stateData && data.stateData.length > 0){
                        $.each(data.stateData, function(index, item) {
                            regionSelect.append('<option value="' + item.id + '">' + item.name + '</option>');
                        });
                        $('label[for="region_id"]').text('State:');

                    } else {
                        $('label[for="region_id"]').text('Region/City/State:');

                        // regionSelect.append('<option value="">No data found</option>');
                    }
                }
            });
        });

        $('select[name="type"]').on('change', function() {
            var constracTypeId = $(this).val();
            $.ajax({
                url: '/get-contract_subtypes/' + constracTypeId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    var subtpe = $('select[name="subtype"]');
                    subtpe.empty();
                    subtpe.append('<option value="">Choose</option>');
                    if (data.length > 0) {
                        $.each(data, function(index, item) {
                            subtpe.append('<option value="' + item.name + '">' + item.name + '</option>');
                        });
                    }
                }
            });
        });
    });
    document.addEventListener("DOMContentLoaded", function() {

        var contractTypeSelect = document.getElementById('contractType');
        var regionalAgreementFields = document.querySelectorAll('.regionalAgreementFields');
        var prefixInput = document.getElementById('prefixInput');
        var subcontractField = document.getElementById('subcontractField');


        contractTypeSelect.addEventListener('change', function() {
            if (contractTypeSelect.value === 'Bilateral Agreement' || contractTypeSelect.value === 'Memorandum Of Understanding') {
                var selectedValue = contractTypeSelect.value;
                var prefix = '';
                if (selectedValue === 'Bilateral Agreement') {
                    prefix = 'BI';
                } else if (selectedValue === 'Memorandum Of Understanding') {
                    prefix = 'MOU';
                } else {
                    prefix = '';
                }
                prefixInput.value = prefix;
                regionalAgreementFields.forEach(function(field) {
                    field.style.display = 'block';
                });
                subcontractField.style.display = 'none';
            } else {
                var contractSubTypeSelect = document.getElementById('contractSubType');
                contractSubTypeSelect.addEventListener('change', function() {
                    var selectedSubType = contractSubTypeSelect.value;
                    prefixInput.value = selectedSubType;
                });


                function updateSubTypeRequired() {
                    var selectedType = contractTypeSelect.value;
                    var isRequired = selectedType === 'Regional Agreement' || selectedType === 'Multilateral Agreement';

                    if (isRequired) {
                        contractSubTypeSelect.setAttribute('required', 'required');
                    } else {
                        contractSubTypeSelect.removeAttribute('required');
                    }
                }
                contractTypeSelect.addEventListener('change', updateSubTypeRequired);
                updateSubTypeRequired();

                regionalAgreementFields.forEach(function(field) {
                    field.style.display = 'none';
                });
                subcontractField.style.display = 'block';

            }
        });
        contractTypeSelect.dispatchEvent(new Event('change'));

        var checkbox = document.getElementById('signed_checkbox');
        var signedDateField = document.getElementById('signedDateField');
        var countryField = document.getElementById('countryField');
        var regionField = document.getElementById('regionField');
        function updateSignedDateField() {
            if (checkbox.checked) {
                signedDateField.style.display = 'block';
                countryField.style.display = 'block';
                regionField.style.display = 'block';
            } else {
                signedDateField.style.display = 'none';
                countryField.style.display = 'none';
                regionField.style.display = 'none';
                document.querySelector('input[name="signed_at"]').value = '';
                document.querySelector('select[name="country_id"]').value = '';
                document.querySelector('select[name="region_id"]').value = '';
            }
        }
        checkbox.addEventListener('change', updateSignedDateField);
        updateSignedDateField();

        var checkbox1 = document.getElementById('ratified_checkbox');
        var ratifiedDateField = document.getElementById('ratifiedDateField');
        function updateRatifiedDateField() {
            if (checkbox1.checked) {
                ratifiedDateField.style.display = 'block';
            } else {
                ratifiedDateField.style.display = 'none';
                document.querySelector('input[name="ratified_at"]').value = '';
            }
        }
        checkbox1.addEventListener('change', updateRatifiedDateField);
        updateRatifiedDateField();




    });
    </script>
@endsection
