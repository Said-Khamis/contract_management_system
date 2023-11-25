<?php

namespace App\Services;

use App\Models\ContractObjective;
use App\Models\ContractOperationArea;
use App\Models\GeneralStatus;
use App\Models\ImplementationStatus;
use App\Repositories\ImplementationStatusRepository;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class ImplementationStatusService
{
    /**
     * @var string
     */
    protected string $implementation_dir = "public/implementation_statuses";
    public function __construct(
        protected ImplementationStatusRepository $implementationStatusRepository,
        protected ContractService                $contractService,
        protected ContractObjectiveService       $contractObjectiveService,
        protected ContractOperationAreaService   $contractCooperationAreaService,
        protected GeneralStatusService           $generalStatusService){

    }

    public function getImplementationStatus(int|string $id): Model|null {
        return $this->implementationStatusRepository->find((int) $id);
    }

    /**
     * Create Implementation Status for the Area of Cooperation
     *
     * @param array $input
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo|Model
     * @throws \Throwable
     */
    public function createImplementationStatus(array $input): \Illuminate\Database\Eloquent\Relations\MorphTo|Model
    {
        $statusGet = [];
        $contractId = decode($input['contract_id']);
        DB::beginTransaction();
        try {
            $contract = $this->contractService->getContract($contractId);

            if (empty($contract)) {
                throw new ModelNotFoundException('Contract not found');
            }

            $status =  new ImplementationStatus();
            if ($input["type"] === "contract_operation_area"){
                $areaCooperation = ContractOperationArea::find($input["id"]);
                $statusGet = $status->implementable()->create([
                    "implementable_type" => ContractOperationArea::class,
                    "implementable_id" => $areaCooperation->id,
                    "contract_id" => $contract->id,
                    "comment" => $input["comments"],
                    "percent" => $input["percent"]
                ]);
            }else if ($input["type"] === "contract_objectives"){
                $objectives = ContractObjective::find($input["id"]);
                $statusGet = $status->implementable()->create([
                    "implementable_type" => ContractObjective::class,
                    "implementable_id" => $objectives->id,
                    "contract_id" => $contract->id,
                    "comment" => $input["comments"],
                    "percent" => $input["percent"]
                ]);
            }else {
                $gStatus = GeneralStatus::find($input["id"]);
                $statusGet = $status->implementable()->create([
                    "implementable_type" => GeneralStatus::class,
                    "implementable_id" => $gStatus->id,
                    "contract_id" => $contract->id,
                    "comment" => $input["comments"],
                    "percent" => $input["percent"]
                ]);
            }
        }
        catch (Exception $e)  {
            DB::rollBack();
            report($e);
            throw $e;
        }
        DB::commit();
        return $statusGet;
    }

    /**
     * Update Implementation Status
     *
     * @param Model $implementationStatus
     * @param array $inputs
     * @return Model
     * @throws \Throwable
     */
    public function updateImplementationStatus(Model $implementationStatus, array $inputs): Model|array
    {
        $updatedStatus = [];
        DB::beginTransaction();
        try {
            //$status = $this->implementationStatusRepository->update($inputs, $implementationStatus->id);
            $status = ImplementationStatus::where("id", $implementationStatus->id)
                           ->update([
                                   "comment" => $inputs["comments"],
                                   "percent" =>  $inputs["percent"]
                               ]);
            if($status === 1){
                $updatedStatus = ImplementationStatus::find($implementationStatus->id);
            }

        } catch (Exception $e) {
            DB::rollback();
            report($e);
            throw $e;
        }
        DB::commit();
        return $updatedStatus;
    }

    /**
     * @param Model $implementationStatus
     * @return void
     * @throws \Throwable
     */
    public function deleteImplementationStatus(Model $implementationStatus): void
    {
        DB::beginTransaction();
        try {
            $this->implementationStatusRepository->delete($implementationStatus->id);
        } catch (Exception $e)
        {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
    }

    public function getTopFivePerformance(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->implementationStatusRepository->topFivePerformance();
    }
}
