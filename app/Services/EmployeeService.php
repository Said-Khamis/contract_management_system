<?php

namespace App\Services;

use App\Repositories\EmployeeRepository;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Throwable;
use Exception;

class EmployeeService
{
    public function __construct(protected EmployeeRepository $employeeRepository){}

    /**
     * Fetch list of all employee in database
     * @return LengthAwarePaginator paginated results
     */
    public function findAll(): LengthAwarePaginator
    {
        return $this->employeeRepository->paginate(10);
    }

    /**
     * creating new employee
     * @param array $input user inputs
     * @throws Throwable
     */
    public function createEmployee(array $input): Model
    {
        return DB::transaction(function () use ($input){
            return $this->employeeRepository->create($input);
        });
    }

    /**
     * fetch one  employee by its id
     * @param int $id id of primary key of a single employee
     * @return Model|Collection|Builder|array|null a employee instance of a model
     */
    public function getEmployee(int $id): Model|Collection|Builder|array|null
    {
        return $this->employeeRepository->find($id);
    }

    /**
     * Update employee details
     * @param array $input new employee input details to edit from employee
     * @param int $id id of primary key of a employee object we need to update
     * @return Model
     * @throws Throwable
     */
    public function updateEmployee(array $input, int $id): Model
    {
        return DB::transaction(function () use ($input,$id){
            return $this->employeeRepository->update($input,$id);
        });
    }

    /**
     * delete a employee from a database category table
     *
     * @throws Exception
     * @throws Throwable
     */
    public function deleteEmployee(int $id): bool
    {
        return DB::transaction(function () use ($id){
            return $this->employeeRepository->delete($id);
        });
    }

}