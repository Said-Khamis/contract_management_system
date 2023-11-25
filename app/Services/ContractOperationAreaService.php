<?php /** @noinspection PhpPossiblePolymorphicInvocationInspection */

/** @noinspection PhpUndefinedFieldInspection */

namespace App\Services;

use App\Models\Contract;
use App\Repositories\ContractOperationAreaRepository;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Throwable;

class ContractOperationAreaService
{
    public function __construct(protected ContractOperationAreaRepository $operationAreaRepository) {}

    /**
     * Create new contract operation area
     * @param array $input new contract operation area input details to be created from user
     * @return Model
     * @throws Throwable
     */
    public function createContractOperationArea(array $input) : Model
    {
        return DB::transaction(function() use ($input) {
            if(isset($input['contract_id'])) {
                $contract = Contract::find($input['contract_id']);
                return $this->create($contract, $input);
            }
            throw  new ModelNotFoundException("No contract with id " . $input['contract_id']);
        });
    }

    /**
     * @throws Throwable
     */
    public function createMultiple(array $input) : void
    {
        foreach ($input['area'] as $key => $value){
            $newInput = [
                'area' => $input['area'][$key],
                'details' => $input['details'][$key],
                'contract_id' => $input['contract_id'],
                'contract_operation_area_id' => $input['contract_operation_area_id'][$key],
            ];
            $this->createContractOperationArea($newInput);
        }
    }

    /**
     * adding contract operation area from existing contract
     * @param Model $contract
     * @param array $input
     * @return Model
     * @throws Throwable
     */
    public function addContractOperationArea(Model $contract, array $input): Model
    {
        return DB::transaction(function() use ($input, $contract) {
            return $this->create($contract, $input);
        });
    }

    /**
     * Update contract operation area details
     * @param array $input new contract operation area input details to be edited from user
     * @param int $id The given id of a contract operation area object needed to be updated
     * @return Model
     * @throws Throwable
     */
    public function updateContractOperationArea(array $input, int $id) : Model
    {
//        dd($input);

        return DB::transaction(function () use ($input, $id) {
//            dd($input);
            foreach ($input['details'] as $key => $value){
                $newInput = [
                    'details' => $input['details'][$key],
                    'contract_operation_area_id' => $input['contract_operation_area_id'][$key],
                    'contract_id' => $input['contract_id'],
                ];
                return $this->operationAreaRepository->update($newInput, $id);
            }
        });


//        return DB::transaction(function() use ($input, $id) {
//            return $this->operationAreaRepository->update($input, $id);
//        });
    }



    /**
     * Delete contract operation area from the database
     * @param int $id The given id of a contract operation area
     * @throws Exception|Throwable
     */
    public function deleteContractOperationArea(int $id)
    {
       return DB::transaction(function() use ($id) {
           return $this->operationAreaRepository->delete($id);
       });
    }

    /**
     * Fetch a specific contract operation area given its id
     * @param int $id The given id of a contract operation area
     * @return Model|null a contract operation area instance of a model
     */
    public function getContractCooperationArea(int $id) : Model|null
    {
        return $this->operationAreaRepository->find($id);
    }

    /**
     * Fetch list of all contractss operation area in database
     * @return LengthAwarePaginator paginated results
     */
    public function findAll() : LengthAwarePaginator
    {
        return $this->operationAreaRepository->paginate(10);
    }

    /**
     * @param Model $contract
     * @param array $input
     * @return Model
     */
    private function create(Model $contract, array $input): Model
    {
        $createdArea = '';
        if (!is_null($input['contract_operation_area_id'])) {
            $area = $this->getContractCooperationArea($input['contract_operation_area_id']);
            if ($area) {
                $newContractArea = $this->operationAreaRepository->new($input);
                $newContractArea->contract_operation_area_id = $area->id;
                $createdArea = $this->operationAreaRepository->saveWithRelation($newContractArea, $contract, 'contractOperationAreas');
            }
        } else {
            $createdArea = $this->operationAreaRepository->createWithRelation($input, $contract, 'contractOperationAreas');
        }
        return $createdArea;
    }
}
