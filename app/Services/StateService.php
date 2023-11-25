<?php

namespace App\Services;

use App\Models\State;
use App\Repositories\StateRepository;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class StateService
{

    public function __construct(protected StateRepository $stateRepository){}

    /**
     * creating new State
     * @param array $input new State input details to create State in State table
     * @return Model
     */
    public function createState(array $input): Model
    {
        return DB::transaction(function () use ($input) {
            // Code to be executed within the transaction
            return $this->stateRepository->create($input);
        });
    }

    /**
     * Fetch list of all State in database
     * @return Collection | Array
     */
    public function findAll() : Collection | Array
    {
        return $this->stateRepository->getStates();
    }
    /**
     * fetch one  State by its id
     * @param int $id id of primary key of a single State
     * @return Model|Collection|Builder|array|null a State instance of a model
     */
    public function getState(int $id): Model|Collection|Builder|array|null
    {
        return $this->stateRepository->find($id);
    }

    /**
     * Update State details
     * @param array $input new State input details to edit from State
     * @param int $id id of primary key of a State object we need to update
     * @return Model|Collection|Builder|array
     */
    public function updateState(array $input, int $id): Model|Collection|Builder|array
    {
        return DB::transaction(function () use ($input,$id) {
            return $this->stateRepository->update($input,$id);
        });
    }
    /**
     * delete a State from a database State table
     * @throws Exception
     */
    public function deleteState(int $id)
    {
        return DB::transaction(function () use ($id) {
            return $this->stateRepository->delete($id);

        });
    }
}
