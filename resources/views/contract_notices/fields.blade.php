
<!-- Details Field -->
<div class="form-group col-sm-6 mt-3">
    {!! Form::label('notice_date', 'Date:') !!}
    {!! Form::date('notice_date', null, ['class' => 'form-control']) !!}
</div>
<div class="form-group col-sm-6 mt-3">
    {!! Form::label('type', 'Type:') !!}
    <select name="notice_type" id="notice_type" class="form-control">
        <option value="Termination">Termination</option>
        <option value="Ammendment">Ammendment</option>
        <option value="Renewal">Renewal</option>
        <option value="Communication">Communication</option>
    </select>
</div>

<!-- Details Field -->
<div class="form-group col-sm-12">
    {!! Form::label('details', 'Descriptions:') !!}
    {!! Form::textarea('details', null, ['class' => validateInput($errors, 'details'). ' form-control','rows' => 3, 'cols' => 10, 'rowspan' => 2, 'colspan' => 3]) !!}
    {!! Form::hidden('contract_id', isset($contract) ? $contract->id : $contractNotice->contract_id, ['class' => 'form-control custom-select']) !!}
</div>


@if($contractNotice)
    @foreach($contractNotice?->attachments as $attachment)
        <div class="form-group col-sm-10 mt-2">
            {!! Form::label('attachment_type', 'Choose New File (Optional)', ['class' => 'form-label mb-0']) !!}
            <input type="file" id="attachment_files" class="form-control " name="attachment_files[]" accept=".pdf" />
            <input type="hidden" id="attachment_id" class="form-control " name="attachment_id[]" value="{{$attachment->id}}"/>
        </div>
        <div class="form-group col-sm-2 mt-2">
            {!! Form::label('file', 'View File', ['class' => 'form-label mb-0']) !!}
            <a target="_blank" style="color: blue;margin-right: 2em"
               title="View {{ucwords(str_replace("_", " ", $attachment->name))}} File"
               class="btn btn-warning btn-sm d-block mt-1"
               href="{{\Illuminate\Support\Facades\Storage::url($attachment->url)}}">
                <i class="ri-file-pdf-fill align-bottom me-2 text-muted">
                </i>
            </a>
        </div>
    @endforeach
@else
    <!-- Attachment Field -->
    <div class="form-group col-sm-12 mt-1">
        <livewire:attachment-container :name="'Add'" />
    </div>
@endif
