<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ContractDeliveryEditForm extends Component
{
    public $unit = '';
    public $showEachContent = false;
    public $showAtContent = false;

    public function updatedUnit($value)
    {
        if ($value === 'each') {
            $this->showEachContent = true;
            $this->showAtContent = false;
        } elseif ($value === 'at') {
            $this->showEachContent = false;
            $this->showAtContent = true;
        } else {
            $this->showEachContent = false;
            $this->showAtContent = false;
        }
    }

    public function render()
    {
        return view('livewire.contract-delivery-edit-form');
    }
}
