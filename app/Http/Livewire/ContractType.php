<?php

namespace App\Http\Livewire;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;

class ContractType extends Component
{
    public $type;
    public function render(): View|Application|Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('livewire.contract-type');
    }
    public function updatedType(): void
    {
        $this->type === 'Bilateral Agreement' || $this->type === 'Memorandum Of Understanding' ? $this->type = true : $this->type = false;
    }
}
