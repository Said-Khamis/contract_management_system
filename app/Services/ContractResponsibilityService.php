<?php

namespace App\Services;

use App\Repositories\ContractResponsibilityRepository;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Throwable;

class ContractResponsibilityService
{
    public function __construct(protected ContractResponsibilityRepository $contractResponsibilityRepository) {}

    /**
     * Create new contract responsibility
     * @param array $input new contract responsibility input details to be created from user
     * @return Model
     * @throws Throwable
     */
    public function createContractResponsibility(array $input) : Model
    {
       return DB::transaction(function() use ($input) {
           return $this->contractResponsibilityRepository->create($input);
       });
    }

    /**
     * Update contract responsibility details
     * @param array $input new contract responsibility input details to be edited from user
     * @param int $id The given id of a contract responsibility object needed to be updated
     * @return Model
     * @throws Throwable
     */
    public function updateContractResponsibility(array $input, int $id) : Model
    {
        return DB::transaction(function() use ($input, $id) {
            return $this->contractResponsibilityRepository->update($input, $id);
        });
    }

    /**
     * Delete contract responsibility from the database contract responsibility table
     * @param int $id The given id of a contract responsibility
     * @throws Exception Throws exception if the operation fails
     * @throws Throwable
     */
    public function deleteContractResponsibility(int $id)
    {
        return DB::transaction(function() use ($id) {
            return $this->contractResponsibilityRepository->delete($id);
        });
    }

    /**
     * Fetch a specific contract responsibility given its id
     * @param int $id The given id of a contract responsibility
     * @return Model|null a contract responsibility instance of a model
     */
    public function getContractResponsibility(int $id) : Model|null
    {
        return $this->contractResponsibilityRepository->find($id);
    }

    /**
     * Fetch list of all contract responsibilities in database
     * @return LengthAwarePaginator paginated results
     */
    public function findAll() : LengthAwarePaginator
    {
        return $this->contractResponsibilityRepository->paginate(10);
    }
}

