<div class="row mb-3">
    <div class="col-md-6 col-xs-6">
        <!-- Attachment Type Field -->
        <div class="form-group col px-2">
            {!! Form::label('attachment_type', 'Attachment Type', ['class' => 'form-label mb-0']) !!}
            <select name="attachment_type[]" id="attachment_type" wire:model="attachment_type" class="form-control">
                <option>-- Please Select --</option>
                <option value="agreement">Agreement</option>
                <option value="note_verbal">Note Verbal</option>
                <option value="letter_of_intent">Letter of Intent</option>
                <option value="instrument_of_ratification">Instrument of Ratification</option>
            </select>

        </div>
    </div>
    <div class="col-md-6 col-xs-6">
        <!-- Attachment File Field -->
        <div class="form-group col px-2">
            <label for="attachment_files" class="form-label mb-0">
                @if($attachment_type)
                    {{$attachment_type == '-- Please Select --' ? "" : str_replace('_', ' ', ucwords($attachment_type))}}
                @endif
            </label>
            <input type="file" id="attachment_files" class="form-control {{validateInput($errors, $attachment_type)}}" name="attachment_files[]" accept=".pdf" />
            @error('attachment_files')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>
</div>
