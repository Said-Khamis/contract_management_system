<?php

namespace App\Services;

use App\Models\Institution;
use App\Repositories\InstitutionRepository;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Throwable;
use Illuminate\Database\Eloquent\Collection;

class InstitutionService
{

    public function __construct(protected InstitutionRepository $institutionRepository){}

    public function findAll(): Collection|Array {
        return $this->institutionRepository->getLocalInstitutions();
    }

    /**
     * Create new institute into the database records
     * @param array $input - The input data of institution captured from user
     * @return Model
     * @throws Throwable
     */
    public function createInstitution(array $input): Model
    {
        return DB::transaction(function() use ($input) {

            $institution  = Institution::where("name",$input["name"])->first();
            if ($institution !== null && $institution->trashed()) {
                $institution->restore();
            }else{
                $institution =  $this->institutionRepository->create($input);
            }
            return $institution;

        });
    }

    /**
     * Fetch one  institution by its id
     * @param int $id id of primary key of a single institution
     * @return Model|null an institution instance of a model or null
     */
    public function getInstitution(int $id): Model|null{
        return $this->institutionRepository->getInstituteWithParent($id);
    }

    public function getLocal(){
        return $this->institutionRepository->getLocal();
    }

    public function getSectors(): Collection {
        return $this->institutionRepository->where('is_local', true)->get();
    }

    /**
     * Update institution details
     * @param array $input new institution input details to edit from institution
     * @param int $id id of primary key of an institution object we need to update
     * @return Model
     * @throws Exception|Throwable
     */
    public function updateInstitution(array $input, int $id): Model
    {
        return DB::transaction(function() use ($input, $id) {
            if(!isset($input['is_local'])){
                $input['is_local'] = false;
            }
            if(!isset($input['sector_id'])){
                $input['sector_id'] = false;
            }
            return $this->institutionRepository->update($input,$id);
        });
    }

    /**
     * delete a institution from a database category table
     * @param int $id - Primary key of an institution object needed to be deleted
     * @return bool
     * @throws Exception|Throwable
     */
    public function deleteInstitution(int $id): bool
    {
        return DB::transaction(function() use ($id) {
            return $this->institutionRepository->delete($id);
        });
    }
}
