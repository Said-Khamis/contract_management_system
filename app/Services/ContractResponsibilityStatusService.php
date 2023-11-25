<?php

namespace App\Services;

use App\Repositories\ContractResponsibilityStatusRepository;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Throwable;

class ContractResponsibilityStatusService
{
    public function __construct(protected ContractResponsibilityStatusRepository $statusRepository){}

    /**
     * Create new contract responsibility status
     * @param array $input new contract responsibility status input details to be created from user
     * @return Model
     * @throws Throwable
     */
    public function createContractResponsibilityStatus(array $input) : Model
    {
        return DB::transaction(function() use ($input) {
            return $this->statusRepository->create($input);
        });
    }

    /**
     * Update contract responsibility status details
     * @param array $input new contract responsibility status input details to be edited from user
     * @param int $id The given id of a contract responsibility status object needed to be updated
     * @return Model
     * @throws Throwable
     */
    public function updateContractResponsibilityStatus(array $input, int $id) : Model
    {
        return DB::transaction(function() use ($input, $id) {
            return $this->statusRepository->update($input, $id);
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
            return $this->statusRepository->delete($id);
        });
    }

    /**
     * Fetch a specific contract responsibility status given its id
     * @param int $id The given id of a contract responsibility status
     * @return Model|null a contract responsibility status instance of a model
     */
    public function getContractResponsibilityStatus(int $id) : Model|null
    {
        return $this->statusRepository->find($id);
    }

    /**
     * Fetch list of all contract responsibilities status in database
     * @return LengthAwarePaginator paginated results
     */
    public function findAll() : LengthAwarePaginator
    {
        return $this->statusRepository->paginate(10);
    }
}
