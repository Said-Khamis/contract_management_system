<?php /** @noinspection PhpPossiblePolymorphicInvocationInspection */

namespace App\Services;

use App\Models\City;
use App\Models\Country;
use App\Models\Location;
use App\Models\Category;
use App\Models\ContractOperationArea;
use App\Models\Region;
use App\Models\State;
use App\Repositories\ContractNoticeRepository;
use App\Repositories\ContractRepository;
use Carbon\Carbon;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PhpParser\Node\Expr\Array_;
use Ramsey\Collection\Collection;
use Throwable;
use Yajra\DataTables\Facades\DataTables;
use function PHPUnit\Framework\logicalAnd;

class ContractService
{
    /**
     * @var string
     */
    protected string $contracts_dir = "docs/contracts";
    public function __construct(
        protected ContractRepository $contractRepository,
        protected AttachmentService $attachmentService
    ) {}

    /**
     * Fetch list of all contractss in database
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function findAll() : \Illuminate\Database\Eloquent\Collection
    {
        return $this->contractRepository->findAllContracts();
    }

    /**
     * Create new contract
     * @param array $input new contract input details to be created from user
     * @return Model
     * @throws Throwable
     */
    public function createContract(array $input): Model
    {
        return DB::transaction(function () use($input){
            if($input['category_id']==null)
            {
                $contract = $this->contractRepository->create($input);
            }else
            {
                $category = Category::find($input['category_id']);
                $contract = $this->contractRepository->createWithRelation($input, $category, 'contractss');
            }
            $this->attachmentService->createAttachment($contract, $input, $this->contracts_dir, 'attachments');
            return $contract;
        });
    }

    /**
     * @throws Throwable
     */
    public function addContractNotice(ContractNoticeService $contractNoticeService, $contractId, array $input): Model
    {
        $contract = $this->getContract($contractId);
        if($contract){
           return $contractNoticeService->addContractNotice($contract, $input);
        }
        else{
            throw new ModelNotFoundException('model not found');
        }
    }

    /**
     * @param Model $contract
     * @param array $input
     * @return Model
     * @throws Throwable
     */
    public function addContractOperationArea(Model $contract, array $input): Model
    {
        return $this->operationArea->addContractOperationArea($contract, $input);
    }

    /**
     * @throws Throwable
     */
    public function addContractSector(Model $contract, array $input){
        return $this->sectorService->addContractSector($contract, $input);
    }

    /**
     * Update contract details
     * @param array $input new contract input details to be edited from user
     * @param int $id The given id of a contract object needed to be updated
     * @throws Throwable
     */
//    public function updateContract(array $input, int $id)
//    {
//        return DB::transaction(function () use($input, $id) {
//            return $this->contractRepository->update($input, $id);
//        });
//    }

    public function updateContract(array $input, int $id): Model
    {
        return DB::transaction(function () use ($input, $id) {
            if (isset($input['prefix']) && isset($input['reference_no'])) {
                $input['reference_no'] = $input['prefix'] . '-' . $input['reference_no'];
            }
            else{
                if (isset($input['subtype']) && isset($input['reference_no'])) {
                    $input['reference_no'] = $input['subtype'] . '-' . $input['reference_no'];
                }
            }

            if ($input['type']=='Multilateral Agreement' || $input['type']=='Regional Agreement'){
                $input['end_date']=null;
                $input['duration']=null;
                $input['category_id']=null;
            }
            $contract = $this->contractRepository->update($input,$id);
            $this->attachmentService->createAttachment($contract, $input, $this->contracts_dir, 'attachments');
            return $contract;

        });
    }

    /**
     * @throws Throwable
     */
    public function updateSignedContractLocation(Model $contract, array $input){
        return DB::transaction(function () use ($input, $contract) {

            // Check if the contract has an associated location
            $location = $contract->signedLocation;
            if (!$location) {
                $location = new Location();
            }
            $locations = Country::find($input['country_id']);
            if ($locations->hasCity == 1) {$location->district_id = $input['region_id'];}
            if ($locations->hasState == 1) {$location->state_id = $input['region_id'];}
            if ($locations->hasRegion == 1) {
                $location->region_id = $input['region_id'];
            }
            $location->country_id = $input['country_id'];
            $contract->signedLocation()->save($location);
            $contract->signed_place =  $location->id;
            $contract->save();
        });
    }


    /**
     * Delete contract from the database
     * @param string|int $id The given id of a contract
     * @return mixed
     * @throws Throwable
     */
    public function deleteContract(string|int $id): mixed
    {
        return DB::transaction(function() use ($id){
             return $this->contractRepository->delete($id);
         });
    }

    /**
     * Fetch a specific contract given its id
     * @param string|int $id The given id of a contract
     * @return Model|null a contract instance of a model
     */
    public function getContract(string|int $id) : Model|null {
        return $this->contractRepository->find($id);
    }

    /**
     * updating contract signed location with new location id
     * @param int $locationId
     * @param Model $contract new updated contract model ready to be persisted
     * @throws Throwable
     */
    private function updateSignedLocation(int $locationId, Model $contract): void
    {
        $contract->signed_place = $locationId;
        $this->updateContract($contract->toArray(), $contract->id);
    }

    /**
     * @throws Throwable
     */
    public function setSigneLocation(Model $contract, array $input, LocationService $locationService):void
    {
        $locationInput = $locationService->setLocationInputs($input);
        $signedLocation = $locationService->createLocation($contract, $locationInput, 'signedLocation');
        $this->updateSignedLocation($signedLocation->id, $contract);
    }

    /**
     * Get the latest Signed three agreements
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getRecentSigned(): \Illuminate\Database\Eloquent\Collection
    {
        return $this->contractRepository->recent();
    }

    /**
     * @param int $category
     * @param bool $signed
     * @return int
     */
    public function getCount(int $category, bool $signed=false): int
    {
        return $this->contractRepository->count($category, $signed);
    }

//    public function updateSignedLocation(Model $contract, array $input, LocationService $locationService):void
//    {
//        $locationInput = $locationService->setLocationInputs($input);
//        $signedLocation = $locationService->createLocation($contract, $locationInput, 'signedLocation');
//        $this->updateSignedLocation($signedLocation->id, $contract);
//    }

     public function countByType($type): int
     {
       return $this->contractRepository->countByType($type, true);
     }

}
