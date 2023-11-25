<?php

namespace App\Services;

use App\Models\Department;
use App\Repositories\DepartmentRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Throwable;
use Exception;

class DepartmentService
{
    public function __construct(protected DepartmentRepository $departmentRepository){}

    /**
     * Fetch list of all department in database
     * @return LengthAwarePaginator paginated results
     */
    public function findAll(): Collection| Array{
       if(auth()->user()->can("oversee all")){
           return $this->departmentRepository->with("institution")
               ->all();
       }
        $instId = auth()->user()->institution->id;
        return $this->departmentRepository->getDepartmentsByInstitutionId($instId);
    }

    /**
     * creating new department
     * @param array $input user inputs
     * @throws Throwable
     */
    public function createDepartment(array $input): Model
    {
        return DB::transaction(function () use ($input){
            return $this->departmentRepository->create($input);
        });
    }

    /**
     * fetch one  department by its id
     * @param int $id id of primary key of a single department
     * @return Model|Collection|Builder|array|null a department instance of a model
     */
    public function getDepartment(int $id): Model|Collection|Builder|array|null
    {
        return $this->departmentRepository->find($id);
    }

    /**
     * Update department details
     * @param array $input new department input details to edit from department
     * @param int $id id of primary key of a department object we need to update
     * @return Model
     * @throws Throwable
     */
    public function updateDepartment(array $input, int $id): Model
    {
        return DB::transaction(function () use ($input,$id){
            return $this->departmentRepository->update($input,$id);
        });
    }

    /**
     * delete a department from a database category table
     *
     * @throws Exception
     * @throws Throwable
     */
    public function deleteDepartment(int $id): bool
    {
        return DB::transaction(function () use ($id){
            return $this->departmentRepository->delete($id);
        });
    }

}