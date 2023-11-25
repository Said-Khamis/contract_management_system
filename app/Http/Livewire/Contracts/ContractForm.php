<?php

namespace App\Http\Livewire\Contracts;

use App\Http\Requests\CreateContractRequest;
use App\Models\Contract;
use App\Models\ContractSubtype;
use App\Models\Country;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class ContractForm extends Component
{
    public string $title,$type='', $duration;
    public $signed_at, $ratified_at, $start_date, $end_date;
    public $category_id,$homePartySelected,$foreignPartySelected;
    public bool $isSigned = false, $isRatified = false, $amended, $hasRegions = false, $hasCity = false, $hasState = false;
    public int$region_id,$district_id,$ward_id,$state_id,$city_id;
    public ?int $country_id = null;
    public $subtype;
    public $reference_no_prefix;

    public ?string $reference_no = null;

    /**
     * @throws ValidationException
     */
    public function updated($propertyName){
        $rules = (new CreateContractRequest())->rules();
        $this->validateOnly($propertyName, $rules);
    }


    public function getSubTypesByType($type)
    {
        if ($type=='Bilateral Agreement'){
            $this->reference_no_prefix = 'BI';
            return  $this->reference_no = $this->reference_no_prefix ;
        }elseif($type=='Memorandum Of Understanding'){
            $this->reference_no_prefix = 'MOU';
            return  $this->reference_no = $this->reference_no_prefix;
        }else{
//            $this->reference_no='';
            return ContractSubtype::where('type', $type)->get();
        }
    }

    public function updatedSubtype($selectedSubtype)
    {
        $subType = ContractSubType::find($selectedSubtype);
        if ($subType) {
            $this->reference_no_prefix = $subType->name;
            $this->reference_no = $this->reference_no_prefix  ;
        } else {
            $this->reference_no = null;
        }
    }
    private function getCountryData()
    {
        $country = Country::find($this->country_id);
        if($country->hasRegion){
            $this->hasRegions = true;
            $this->hasState = false;
            $this->hasCity = false;
        }

        elseif ($country->hasState){
            $this->hasRegions = false;
            $this->hasState = true;
            $this->hasCity = false;
        }

        elseif ($country->hasCity){
            $this->hasRegions = false;
            $this->hasState = false;
            $this->hasCity = true;
        }

    }
    public function render()
    {
        if($this->country_id){
            $this->getCountryData();
        }

        $subTypes = $this->getSubTypesByType($this->type);
        return view('contracts.livewire_create', compact('subTypes'))->extends('layouts.master');
    }
}
