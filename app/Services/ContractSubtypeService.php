<?php

namespace App\Services;

use App\Models\Contract;
use App\Repositories\ContractSubtypeRepository;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Throwable;

class ContractSubtypeService
{
    public function __construct(protected ContractSubtypeRepository $subTypeRepositories) {}

    /**
     * Create new contract sector
     * @param array $input new contract sector input details to be created from user
     * @return Model
     * @throws Throwable
     */
    public function createContractSubType(array $input) : Model
    {
        DB::beginTransaction();
        try {
            $sector = $this->subTypeRepositories->create($input);
        } catch (Exception $e)
        {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        return $sector;
    }

    /**
     * @throws Throwable
     */
    public function addContractSector(Model $contract, $input){
        return DB::transaction(function () use ($input, $contract) {
            if($contract){
                $this->subTypeRepositories->createWithRelation($input, $contract,'contractSectors');
            }
        });
    }

    /**
     * adding multiple contract sectors
     * @param Model $contract contract model object
     * @param $inputs array of inputs array (multiple inputs of sectors to be added)
     * @throws Throwable
     */
    public function addMultipleSectors(Model $contract, array $inputs): void
    {
        foreach ($inputs as $input){
            $this->addContractSector($contract, $input);
        }
    }

    /**
     * Update contract sector details
     * @param array $input new contract sector input details to be edited from user
     * @param int $id The given id of a contract sector object needed to be updated
     * @return Model
     * @throws Throwable
     */
    public function updateContractSubType(array $input, int $id) : Model
    {
        return DB::transaction(function () use ($input,$id) {
            $input["is_owner"] = $input["is_owner"] ?? 0;
            $input["is_current_implementer"] = $input["is_current_implementer"] ?? 0;
            return $this->subTypeRepositories->update($input,$id);
        });
    }

    /**
     * Delete contract sector from the database
     * @param int $id The given id of a contract sector
     * @throws Exception|Throwable
     */
    public function deleteContractSubType(int $id)
    {
        return DB::transaction(function () use ($id) {
            return $this->subTypeRepositories->delete($id);
        });
    }

    /**
     * Fetch a specific contract sector given its id
     * @param int $id The given id of a contract sector
     * @return Model|null a contract sector instance of a model
     */
    public function getContractSubType(int $id) : Model|null
    {
        return $this->subTypeRepositories->find($id);
    }

    /**
     * Fetch list of all contractss sector in database
     * @return Collection results
     */
    public function findAll() : Collection
    {
        return $this->subTypeRepositories->getContractSubTypes();
    }
}
