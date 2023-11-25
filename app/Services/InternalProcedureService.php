<?php

namespace App\Services;

use App\Repositories\InternalProcedureRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Throwable;
use Exception;

class InternalProcedureService
{
    public function __construct(protected InternalProcedureRepository $internalProcedureRepository){}

    /**
     * Fetch list of all internalProcedure in database
     * @return LengthAwarePaginator paginated results
     */
    public function findAll(): LengthAwarePaginator
    {
        return $this->internalProcedureRepository->paginate(10);
    }

    /**
     * creating new internalProcedure
     * @param array $input user inputs
     * @throws Throwable
     */
    public function createInternalProcedure(array $input): Model
    {
        return DB::transaction(function () use ($input){
            return $this->internalProcedureRepository->create($input);
        });
    }

    /**
     * fetch one  internalProcedure by its id
     * @param int $id id of primary key of a single internalProcedure
     * @return Model|Collection|Builder|array|null a internalProcedure instance of a model
     */
    public function getInternalProcedure(int $id): Model|Collection|Builder|array|null
    {
        return $this->internalProcedureRepository->find($id);
    }

    /**
     * Update internalProcedure details
     * @param array $input new internalProcedure input details to edit from internalProcedure
     * @param int $id id of primary key of a internalProcedure object we need to update
     * @return Model
     * @throws Throwable
     */
    public function updateInternalProcedure(array $input, int $id): Model
    {
        return DB::transaction(function () use ($input,$id){
            return $this->internalProcedureRepository->update($input,$id);
        });
    }

    /**
     * delete a internalProcedure from a database category table
     *
     * @throws Exception
     * @throws Throwable
     */
    public function deleteInternalProcedure(int $id): bool
    {
        return DB::transaction(function () use ($id){
            return $this->internalProcedureRepository->delete($id);
        });
    }

}