<!-- resources/views/livewire/contract-delivery-form.blade.php -->

<div>
    <div class="form-group col-sm-6">
        <label for="unit">Unit:</label>
        <select wire:model="unit" class="form-control">
            <option value="">Choose</option>
            <option value="each">Each</option>
            <option value="at">At</option>
        </select>
    </div>

    <div wire:ignore.self class="each-content" @if($showEachContent) style="display: block;" @else style="display: none;" @endif>
        <!-- Add your "each" content here -->
    </div>

    <div wire:ignore.self class="at-content" @if($showAtContent) style="display: block;" @else style="display: none;" @endif>
        <!-- Add your "at" content here -->
    </div>
</div>
