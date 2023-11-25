<?php

namespace App\Services;

use App\Models\Designation;
use App\Repositories\DesignationRepository;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class DesignationService
{
    public function __construct(protected DesignationRepository $designationRepository, ){}

     /**
     * creating new designations
     * @param array $input new designations input details to create from user
     * @return Model
     */
    public function createDesignation(array $input): Model
    {
        return $this->designationRepository->create($input);
    }

     /**
     * Update designations details
     * @param array $input new designations input details to edit from user
     * @param int $id id of primary key of a designations object we need to update
     * @return Model|Collection|Builder|array
     */
    public function updateDesignation(array $input, int $id): Model|Collection|Builder|array
    {
        return $this->designationRepository->update($input, $id);
    }

    /**
     * delete a designations from a database designations table
     * @throws Exception
     */
    public function deleteDesignation(int $id)
    {
        return $this->designationRepository->delete($id);
    }

    /**
     * fetch one  designations by its id
     * @param int $id id of primary key of a single designations
     * @return Model|Collection|Builder|array|null a designations instance of a model
     */
    public function getDesignation($id): Model|Collection|Builder|array|null {
        return $this->designationRepository->find($id);
    }

     /**
     * Fetch list of all designations in database
     * @return LengthAwarePaginator paginated results
     */
    public function findAll(): Collection | Array {
        if(auth()->user()->can("oversee all")){
            return $this->designationRepository->with("institution")->all();
        }
        $instId = auth()->user()->institution->id;
        return $this->designationRepository->getDesignationsByInstitutionId($instId);
    }
}
