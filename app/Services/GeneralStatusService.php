<?php

namespace App\Services;

use App\Repositories\GeneralStatusRepository;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class GeneralStatusService
{

    public function __construct(protected GeneralStatusRepository $generalStatusRepository){}
    public function getGeneralStatus(int $id): Model|null {
        return $this->generalStatusRepository->find($id);
    }

    /**
     * @param array $inputs
     * @return Model
     * @throws \Throwable
     */
    public function createGeneralStatus(array $inputs): Model
    {
        DB::beginTransaction();
        try {
            $generalStatus = $this->generalStatusRepository->create($inputs);
        } catch (Exception $e)
        {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        return $generalStatus;
    }

    /**
     * @param Model $model
     * @param array $inputs
     * @return Model
     * @throws \Throwable
     */
    public function updateGeneralStatus(Model $model, array $inputs): Model
    {
        DB::beginTransaction();
        try {
            $generalStatus = $this->generalStatusRepository->update($inputs, $model->id);
        } catch (Exception $e)
        {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
        return $generalStatus;
    }

    /**
     * @param Model $model
     * @return void
     * @throws \Throwable
     */
    public function deleteGeneralStatus(Model $model): void
    {
        DB::beginTransaction();
        try {
            $this->generalStatusRepository->delete($model->id);
        } catch (Exception $e)
        {
            DB::rollBack();
            throw $e;
        }
        DB::commit();
    }
}
