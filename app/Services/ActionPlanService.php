<?php

namespace App\Services;

use App\Models\ActionPlan;
use App\Repositories\ActionPlanRepository;
use Exception;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class ActionPlanService
{
    public function __construct(protected ActionPlanRepository $actionPlanRepository, protected ContractService $contractService){}

    /**
     * creating new action plan
     * @param array $input new action plan input details to create from user
     * @return Model
     * @throws \Throwable
     */
    public function createActionPlan(array $input){

        return DB::transaction(function () use($input){
            $contract = $this->contractService->getContract($input['contract_id']);
            if($contract){
                $actionPlan = ActionPlan::create($input);
                $contract->actionPlans()->save($actionPlan);
            } else {
                Alert::error(new ModelNotFoundException("Contract not found exception"));
                throw new ModelNotFoundException("Contract not found exception");
            }
            return $actionPlan;
        });

    }


    /**
     * Update action plan details
     * @param array $input new action plan input details to edit from user
     * @param int $id id of primary key of a action plan object we need to update
     * @return Model|Collection|Builder|array
     */
    public function updateActionPlan(array $input, int $id){
        DB::beginTransaction();
        try {
          return $this->actionPlanRepository->update($input, $id);
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }
        DB::commit();
    }

     /**
     * delete a action plan from a database action plan table
     * @throws Exception
     */
    public function deleteActionPlan(int $id){
           return $this->actionPlanRepository->delete($id);
    }

    /**
     * fetch one  action plan by its id
     * @param int $id id of primary key of a single action plan
     * @return Model|Collection|Builder|array|null a action plan instance of a model
     */
    public function getActionPlan(int $id): Model|Collection|Builder|array|null{
        return $this->actionPlanRepository->find($id);
    }

    /**
     * Fetch list of all action plans in database
     * @return LengthAwarePaginator paginated results
     */
    public function findAll(): LengthAwarePaginator{
        return $this->actionPlanRepository->paginate(10);
    }
}
