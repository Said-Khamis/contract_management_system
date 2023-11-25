<?php

namespace App\Http\Livewire;

use App\Http\Requests\CreateContractRequest;
use App\Http\Requests\UpdateContractRequest;
use App\Models\Country;
use Livewire\Component;

class ContractEdit extends Component
{
    public $contract;
    public $type;
    public $title;
    public $category;
    public $reference_no;
    public $category_id;

    public $showRatifiedFields = false;
    public $showSignedFields = false;

    public $signed_at, $ratified_at, $start_date, $end_date;
    public bool $isSigned = false, $isRatified = false, $amended, $hasRegions = false, $hasCity = false, $hasState = false;
    public $district_id;
    public $ward_id;
    public $wards = [];
    public int $duration,$region_id;
//    ,$district_id,$ward_id;

    protected $listeners = ['district_id' => 'updatedDistrictId'];

    public ?int $country_id = null;

    /**
    //     * @throws ValidationException
     */
    public function updated($propertyName){
        $rules = (new UpdateContractRequest())->rules();
        $this->validateOnly($propertyName, $rules);
    }

    public function mount($contract)
    {
        // Initialize the selected district and fetch ward options
        $this->district_id = $contract->signedLocation->district_id ?? null;
        $this->ward_id = $contract->signedLocation->ward_id ?? null;
        $this->wards = getPluckedWard($this->district_id);

        $this->contract = $contract;
    }

    public function render()
    {
        $country = Country::find($this->country_id); // Replace with your actual logic to get the selected country
        $hasRegions = $country->hasRegions ?? 0; // Default to 0 if not set

        return view('livewire.contract-edit', ['hasRegions' => $hasRegions]);
//        return view('livewire.contract-edit');
    }

    public function toggleRatifiedFields()
    {
        $this->showRatifiedFields = !$this->showRatifiedFields;
    }
    public function toggleSignedFields()
    {
        $this->showSignedFields = !$this->showSignedFields;
    }

    public function updatedDistrictId($value)
    {
        // Fetch ward options based on the selected district
        $this->wards = getPluckedWard($value);
    }

}
