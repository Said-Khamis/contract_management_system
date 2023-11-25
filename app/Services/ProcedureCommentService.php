<?php

namespace App\Services;

use App\Repositories\ProcedureCommentRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Throwable;
use Exception;

class ProcedureCommentService
{
    public function __construct(protected ProcedureCommentRepository $procedureCommentRepository){}

    /**
     * Fetch list of all procedureComment in database
     * @return LengthAwarePaginator paginated results
     */
    public function findAll(): LengthAwarePaginator
    {
        return $this->procedureCommentRepository->paginate(10);
    }

    /**
     * creating new procedureComment
     * @param array $input user inputs
     * @throws Throwable
     */
    public function createProcedureComment(array $input): Model
    {
        return DB::transaction(function () use ($input){
            return $this->procedureCommentRepository->create($input);
        });
    }

    /**
     * fetch one  procedureComment by its id
     * @param int $id id of primary key of a single procedureComment
     * @return Model|Collection|Builder|array|null a procedureComment instance of a model
     */
    public function getProcedureComment(int $id): Model|Collection|Builder|array|null
    {
        return $this->procedureCommentRepository->find($id);
    }

    /**
     * Update procedureComment details
     * @param array $input new procedureComment input details to edit from procedureComment
     * @param int $id id of primary key of a procedureComment object we need to update
     * @return Model
     * @throws Throwable
     */
    public function updateProcedureComment(array $input, int $id): Model
    {
        return DB::transaction(function () use ($input,$id){
            return $this->procedureCommentRepository->update($input,$id);
        });
    }

    /**
     * delete a procedureComment from a database category table
     *
     * @throws Exception
     * @throws Throwable
     */
    public function deleteProcedureComment(int $id): bool
    {
        return DB::transaction(function () use ($id){
            return $this->procedureCommentRepository->delete($id);
        });
    }

}