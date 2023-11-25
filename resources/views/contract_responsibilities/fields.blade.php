<!-- Details Field -->
<div class="form-group col-sm-12">
    {!! Form::label('details', 'Details:',['class' => 'mb-0']) !!}
    {!! Form::textarea('details', null, ['class' => validateInput($errors, 'details') . ' form-control','rows' => 3, 'cols' => 10, 'rowspan' => 2, 'colspan' => 3]) !!}
    {!! Form::hidden('contract_id', isset($contract) ? $contract->id : $contractResponsibility->contract_id, ['class' => 'form-control custom-select']) !!}
</div>


{{--<!-- Party Field -->--}}
{{--<div class="form-group col-sm-4 mx-auto mt-3 mb-3">--}}
{{--    {!! Form::label('contract_party_id', 'Contract Party:',['class' => 'mb-0']) !!}--}}
{{--    {!! Form::select('contract_party_id',getPluckedContractParty($contract->id)->forget(0)->all(), null, ['class' => validateInput($errors, 'contract_party_id') .' form-control custom-select']) !!}--}}
{{--</div>--}}


{{--<!-- Start Time Field -->--}}
{{--<div class="form-group col-sm-4 mx-auto mt-3 mb-3">--}}
{{--    {!! Form::label('start_time', 'Start Time:',['class' => 'mb-0']) !!}--}}
{{--    <input type="date" name="start_time" class = "form-control {{validateInput($errors, 'start_time')}}">--}}
{{--    @error('start_time')--}}
{{--    <div class="invalid-feedback">{{ $message }}</div>--}}
{{--    @enderror--}}
{{--</div>--}}

{{--<!-- End Time Field -->--}}
{{--<div class="form-group col-sm-4 mx-auto mt-3 mb-3">--}}
{{--    {!! Form::label('end_time', 'End Time:',['class' => 'mb-0']) !!}--}}
{{--    <input type="date" name="end_time" class = "form-control {{validateInput($errors, 'end_time')}}">--}}
{{--    @error('end_time')--}}
{{--    <div class="invalid-feedback">{{ $message }}</div>--}}
{{--    @enderror--}}
{{--</div>--}}
