<?php

namespace App\Http\Livewire\Contracts;

use App\Http\Requests\CreateContractObjectiveRequest;
use App\Http\Requests\CreateContractRequest;
use App\Models\Country;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class ContractObjectivesForm extends Component
{
    public string $details;
    public int $contract_id,$contract_objective_id,$counter = 0;

    /**
     * @throws ValidationException
     */
    public function updated($propertyName){
        $rules = (new CreateContractObjectiveRequest())->rules();
        $this->validateOnly($propertyName, $rules);
    }

    public function render()
    {
        return view('contract_objectives.create')->extends('layouts.master');
    }
}
