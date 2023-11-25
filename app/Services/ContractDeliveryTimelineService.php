<?php /** @noinspection PhpPossiblePolymorphicInvocationInspection */

/** @noinspection PhpUndefinedFieldInspection */

namespace App\Services;

use App\Models\Contract;
use App\Models\ContractDeliveryTimeline;
use App\Repositories\ContractDeliveryTimelineRepository;
use App\Repositories\ContractOperationAreaRepository;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class ContractDeliveryTimelineService
{
    public function __construct(protected ContractDeliveryTimelineRepository $contractDeliveryRepository) {}

    /**
     * Create new contract operation area
     * @param array $input new contract operation area input details to be created from user
     * @return Model
     * @throws Throwable
     */
    public function createContractDeliveryTimeline(array $input) : Model
    {

//        dd($input);
        return DB::transaction(function() use ($input) {
            if(isset($input['contract_id'])) {
                if (is_null($input['time']) && !is_null($input['start_time'])) {
                    $input['time'] = $input['start_time'];
                } elseif (is_null($input['start_time']) && !is_null($input['time'])) {
                    $input['start_time'] = $input['time'];
                }
                if (isset($input['annual_event'])) {
                    $input['annual_event'] = 1;
                }else{
                    $input['annual_event'] = 0;
                }
                return $this->contractDeliveryRepository->create($input);
            }
            throw  new ModelNotFoundException("No contract with id " . $input['contract_id']);
        });
    }

    public function getContractDelivery(int $id) : Model|null
    {
        return $this->contractDeliveryRepository->find($id);
    }
    public function updatedContractDelivery(array $input, int $id) : Model
    {
        return DB::transaction(function() use ($input, $id) {
          return $this->contractDeliveryRepository->update($input,$id);
        });
    }


    public function deleteContractDelivery(int $id)
    {
        return DB::transaction(function() use ($id) {
            return $this->contractDeliveryRepository->delete($id);
        });
    }
}
