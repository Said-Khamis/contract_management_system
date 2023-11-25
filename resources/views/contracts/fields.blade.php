<!-- Type Field -->
<div class="form-group col-sm-6 mb-3">
    <label class="mb-0" for="type">Contract Type</label>
    <span style="font-size: 1.2em;font-weight: bolder" class="text-danger">*</span>
    <select wire:model="type" id="type" class="form-select  @error('type') is-invalid @enderror"
            name="type" required aria-label="Default select example">
        <option value="" selected>Please Select Contract Type</option>
        @foreach(config('data.contract_types') as $key => $value)
            <option value="{{$key}}">{{$value}}</option>
        @endforeach
    </select>
    @error('type')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>
{{--@if ($type)--}}

@if ($type === 'Bilateral Agreement' || $type === 'Memorandum Of Understanding')
    <div class="form-group col-sm-6 mb-3">
        <label class="mb-0" for="type">Contract SubType</label>

    <input title="Not allowed" type="text" style="cursor:not-allowed;" readonly class="form-control"
           name="category_id" value="" onmouseover="this.style.backgroundColor='#e3e3e3'"
           onmouseout="this.style.backgroundColor='transparent'">
    </div>

        @else
    <div class="form-group col-sm-6 mb-3">
        <label class="mb-0" for="type">Contract SubType</label>
        <select   wire:model="subtype" required id="subtype" class="form-select  @error('subtype') is-invalid @enderror" name="subtype"  aria-label="Default select example">
            <option value="" selected>Please Select Contract SubType</option>
            @foreach($subTypes as  $value)
                <option value="{{ $value->id }}">{{ $value->name }}</option>
            @endforeach
        </select>
        @error('type')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
@endif


{{--@endif--}}
<!-- Category Field -->
<div class="form-group col-sm-6 mb-3">
    {!! Form::label('category_id', 'Category:',['class' => 'mb-0']) !!}
    <span style="font-size: 1.2em;font-weight: bolder" class="text-danger">*</span>
    @if ($type === 'Bilateral Agreement' || $type === 'Memorandum Of Understanding')
        <select wire:model="category_id" id="category_id"
                class="form-select @error('category_id') is-invalid @enderror"
                name="category_id" required aria-label="Default select example">
            <option value="" selected>Please Select Category</option>
            @foreach(getPluckedCategory()->forget(1)->all() as $key => $value)
                <option value="{{ $key }}">{{ $value }}</option>
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
    {!! Form::label('title', 'Title:',['class' => 'mb-0']) !!}
    <span style="font-size: 1.2em;font-weight: bolder" class="text-danger">*</span>
    <input type="text" wire:model.lazy="title" name="title" class = "form-control {{validateInput($errors, 'title', $title)}}">
    @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>


<!-- Reference No Field -->
<div class="form-group col-sm-12 mb-3">
    {!! Form::label('reference_no', 'Registration No:',['class' => 'mb-0']) !!}
    <span style="font-size: 1.2em; font-weight: bolder" class="text-danger">*</span>
    <input type="text"  hidden value="{{  $reference_no  }}" name="prefix" class="form-control">
    <input type="number"
           name="reference_no"
           class="form-control {{ validateInput($errors, 'reference_no', $reference_no) }}"
           pattern="\d*"
           title="Please enter only numbers"
           oninput="validateNumberInput(this)">    @error('reference_no')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

@if ($type === 'Bilateral Agreement' || $type === 'Memorandum Of Understanding')
    <div class="col-12">
        <label>BETWEEN</label>
        <hr class="m-0">
        <!-- Institution Field -->
        <div class="row mt-3">
            <div class="form-group col-sm-6 mb-3">
                <label for="home_institution_id" class="form-label">Home Party</label>
                <span style="font-size: 1.2em;font-weight: bolder" class="text-danger">*</span>
                <select wire:model="homePartySelected" class="form-select js-example-basic-single @error('homePartySelected') is-invalid @enderror" name="home_institution_id" required aria-label="Default select example">
                    <option value="" selected>Please Select Institution</option>
                    @foreach(getHomePartiesPluckednstitutions() as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group col-sm-6 mb-3">
                <label for="institution_id" class="form-label">Foreign Party</label>
                <span style="font-size: 1.2em;font-weight: bolder" class="text-danger">*</span>
                <select wire:model="foreignPartySelected" class="form-select js-example-basic-single @error('foreignPartySelected') is-invalid @enderror" name="foreign_institution_id" required aria-label="Default select example">
                    <option value="" selected>Please Select Institution</option>
                    @foreach(getForeignPartiesPluckedInstitutions() as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
            </div>

        </div>
    </div>
@endif

<!-- Start Date Field -->
<div class="form-group col-sm-6 mb-3">
    {!! Form::label('start_date', 'Start Date:',['class' => 'mb-0']) !!}
    <input type="date" wire:model="start_date" name="start_date" class = "form-control {{validateInput($errors, 'start_date', $start_date)}}">
    @error('start_date')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- End Date Field -->
<div class="form-group col-sm-6 mb-3">
    {!! Form::label('end_date', 'End Date:',['class' => 'mb-0']) !!}
    <input type="date"
           {{ ($type === 'Bilateral Agreement' || $type === 'Memorandum Of Understanding') ? '' : 'readonly' }}
           wire:model.debounce.2500ms="end_date" name="end_date" class="form-control {{ validateInput($errors, 'end_date', $end_date) }}"
           onmouseover="{{ ($type === 'Bilateral Agreement' || $type === 'Memorandum Of Understanding') ? '' : "this.style.backgroundColor='#e3e3e3',this.style.cursor='not-allowed'" }}"
           onmouseout="{{ ($type === 'Bilateral Agreement' || $type === 'Memorandum Of Understanding') ? '' : "this.style.backgroundColor='transparent'" }}">
    @error('end_date')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Duration Field -->
<div class="form-group col-sm-6 mb-3">
    {!! Form::label('duration', 'Duration (In Years):',['class' => 'mb-0']) !!}
    <span style="font-size: 1.2em;font-weight: bolder" class="text-danger">*</span>
    <input type="text" {{($type === 'Bilateral Agreement' || $type === 'Memorandum Of Understanding')?'':'readonly'}}
    wire:model="duration" name="duration" class = "form-control
                                                    {{validateInput($errors, 'duration', $duration)}}"
           onmouseover="{{ ($type === 'Bilateral Agreement' || $type === 'Memorandum Of Understanding') ? '' : "this.style.backgroundColor='#e3e3e3',this.style.cursor='not-allowed'" }}"
           onmouseout="{{ ($type === 'Bilateral Agreement' || $type === 'Memorandum Of Understanding') ? '' : "this.style.backgroundColor='transparent'" }}">
    @error('duration')
    <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<!-- Attachment Field -->
<div class="form-group col-sm-6 mb-3">
    <livewire:attachment-container :name="'Add'" />
</div>
<!-- Duration Field -->
<div class="form-group col-sm-6 mb-3">
    <div class="row">
        <div class="col">
            {!! Form::label('is_signed', 'Signed ?', ['class' => 'form-check-label mb-0']) !!}
            <label class="form-check">
                <input type="checkbox" wire:model="isSigned" class="form-check-input">
            </label>
        </div>
        <div class="col">
            {!! Form::label('isRatified', 'Ratified ?', ['class' => 'form-check-label mb-0']) !!}
            <label class="form-check">
                <input type="checkbox" wire:model="isRatified" class="form-check-input">
            </label>
        </div>
    </div>
</div>


@if($isSigned)
    <!-- Date Signed Field -->
    <div class="form-group col-sm-6 mb-3">
        {!! Form::label('signed_at', 'Date Signed:',['class' => 'mb-0']) !!}
        <input type="date"  wire:model="signed_at" name="signed_at" required class = "form-control {{validateInput($errors, 'signed_at', $signed_at)}}">
        @error('signed_at')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <!-- Signed Place Field -->
    <div class="form-group col-sm-6 mb-3">
        <label>Signed Location:</label>
        <hr class="m-0">
        <div class="row">
            @include('locations._fields')
        </div>
    </div>
@endif

@if($isRatified)
    <!-- Ratification Date Field -->
    <div class="form-group col-sm-6 mb-3">
        {!! Form::label('ratified_at', 'Ratification Date:',['class' => 'mb-0']) !!}
        {!! Form::date('ratified_at', null, ['class' => 'form-control','id'=>'ratification_date', 'required' => 'required']) !!}
    </div>
@endif

<!-- Is Amended Field -->
<div class="form-group col-sm-12 mb-3">

</div>

@push('java-scripts')
    <script>
        $(document).ready(function() {
            $('.js-example-basic-single').select2();
        });
    </script>

    <script>
        function validateNumberInput(input) {
            var value = input.value;
            input.value = value.replace(/\D/g, '');
        }
    </script>

@endpush


