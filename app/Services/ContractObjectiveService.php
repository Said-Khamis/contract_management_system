<?php /** @noinspection PhpUndefinedFieldInspection */

/** @noinspection PhpPossiblePolymorphicInvocationInspection */

namespace App\Services;

use App\Models\Contract;
use App\Repositories\ContractObjectiveRepository;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use Throwable;

class ContractObjectiveService
{
    public function __construct(protected ContractObjectiveRepository $objectiveRepository) {}

    /**
     * Create new contract objective
     * @param array $input new contract objective input details to be created from user
     * @return Model
     * @throws Throwable
     */
    public function createContractObjective(array $input) : Model
    {
        return DB::transaction(function () use ($input) {
            $createdObjective = '';

            if(isset($input['contract_id'])) {
                $contract = Contract::find($input['contract_id']);
                if (!$contract) {
                    throw  new ModelNotFoundException("No contract with id " . $input['contract_id']);
                }

                if(!is_null($input['contract_objective_id'])) {
                    $objective = $this->getContractObjective($input['contract_objective_id']);

                    if ($objective) {
                        $newObjective = $this->objectiveRepository->new($input);
                        $newObjective->contract_objective_id = $objective->id;
                        $createdObjective = $this->objectiveRepository->saveWithRelation($newObjective, $contract, 'contractObjectives');
                    }
                    else{
                        throw  new ModelNotFoundException("No contract with id " . $input['contract_id']);
                    }
                }
                else{
                    $createdObjective =  $this->objectiveRepository->createWithRelation($input, $contract, 'contractObjectives');
                }
            }

            return $createdObjective;
        });
    }

    /**
     * @throws Throwable
     */
    public function createMultiple(array $input): void
    {
        foreach ($input['details'] as $key => $value){
            $newInput = [
                'details' => $input['details'][$key],
                'contract_id' => $input['contract_id'],
                'contract_objective_id' => $input['contract_objective_id'][$key],
            ];
            $this->createContractObjective($newInput);
        }
    }

    /**
     * Update contract objective details
     * @param array $input new contract objective input details to be edited from user
     * @param int $id The given id of a contract objective object needed to be updated
     * @return Model
     * @throws Throwable
     */
    public function updateContractObjective(array $input, int $id) : Model
    {
        return DB::transaction(function () use ($input, $id) {
            foreach ($input['details'] as $key => $value){
            $newInput = [
                'details' => $input['details'][$key],
                'contract_id' => $input['contract_id'],
            ];
            return $this->objectiveRepository->update($newInput, $id);
          }
        });

    }

    /**
     * Delete contract objective from the database
     * @param int $id The given id of a contract objective
     * @throws Exception|Throwable
     */
    public function deleteContractObjective(int $id)
    {
        return DB::transaction(function () use ($id) {
            return $this->objectiveRepository->delete($id);
        });
    }

    /**
     * Fetch a specific contract objective given its id
     * @param int $id The given id of a contract objective
     * @return Model|null a contract objective instance of a model
     */
    public function getContractObjective(int $id) : Model|null
    {
        return $this->objectiveRepository->find($id);
    }

    /**
     * Fetch list of all contractss objective in database
     * @return LengthAwarePaginator paginated results
     */
    public function findAll() : LengthAwarePaginator
    {
        return $this->objectiveRepository->paginate(10);
    }
}
