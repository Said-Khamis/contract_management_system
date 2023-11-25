<?php

namespace App\Services;

use App\Models\Contract;
use App\Models\ContractParty;
use App\Models\Institution;
use App\Repositories\ContractPartyRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Throwable;

class ContractPartyService
{

    public function __construct(protected ContractPartyRepository $contractPartyRepository)
    {
    }

    /**
     * @throws Throwable
     */
    public function createContractPart($input){
        return DB::transaction(function() use($input){
            if(isset($input['contract_id'])) {
                $contract = Contract::find($input['contract_id']);
                if (!$contract) {
                    throw  new ModelNotFoundException("No contract with id " . $input['contract_id']);
                }

                $party = Institution::find($input['institution_id']);
                if($party){
                    $input['is_local'] = $party->is_local;
                    //dd($input);
                    $this->contractPartyRepository->associateAndSave($input,[$contract,$party],['contract','institution']);
                }
            }
        });
    }


    public function updateMultipleParties(int $id,$input){

        return DB::transaction(function() use($input,$id){
            if (array_key_exists('home_institution_id', $input)) {
                if ($input['type']=='Multilateral Agreement' || $input['type']=='Regional Agreement'){
                    ContractParty::where('contract_id', $id)->where('is_local', 1)->delete();
                    ContractParty::where('contract_id', $id)->where('is_local', 0)->delete();
                }else{
                    ContractParty::where('contract_id', $id)->where('is_local', 1)->update(['institution_id' => $input['home_institution_id']]);
                    ContractParty::where('contract_id', $id)->where('is_local', 0)->update(['institution_id' => $input['foreign_institution_id']]);
                }
            }
        });
    }

    /**
     * @throws Throwable
     */
    public function createMultipleParties(array $input): void
    {
        foreach ($input as $key => $value){
            //$newInput = $this->setInputs($value, $key);
            $this->createContractPart($value);
        }
    }

    public function setInputs(array $input, int $key = null): array
    {
        if(!is_null( $key)){
            $newInput = [
                'institution_id' => $input['institution_id'][$key],
                'contract_id' => $input['contract_id']
            ];
        }
        else{
            $newInput = [
                'institution_id' => $input['institution_id'],
                'contract_id' => $input['contract_id']
            ];
        }

        return $newInput;

    }

}
