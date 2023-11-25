<?php


namespace App\Services;


use App\Repositories\DistrictRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class DistrictService
{
    public function __construct(
        protected DistrictRepository $districtRepository,
        protected RegionService $regionService
    ){}

    /**
     * @throws Exception|Throwable
     */
    public function createDistrict(array $input): Model
    {
        return DB::transaction(function () use ($input){
            $region = $this->regionService->getRegion($input['region_id']);
            if($region){
                return $this->districtRepository->createWithRelation($input, $region,'districts');
            }
            else{
                Alert::error(new ModelNotFoundException("Region not found exception"));
                throw new ModelNotFoundException("Region not found exception");
            }
        });
    }

    public function findAll(): Collection | array
    {
        return $this->districtRepository->getDistricts();
    }

    public function getDistrict($id): Model|Collection|Builder|array|null
    {
        return $this->districtRepository->find($id);
    }

    /**
     * @throws Exception|Throwable
     */
    public function updateDistrict(array $input, int $id): Model
    {
        return DB::transaction(function () use ($input,$id){
            return  $this->districtRepository->update($input,$id);
        });
    }

    /**
     * @throws Throwable
     */
    public function deleteDistrict(int $id): bool
    {
        return DB::transaction(function () use ($id){
            return $this->districtRepository->delete($id);
        });
    }

    public function getDistrictsDataTable($districts):JsonResponse
    {
        return DataTables::of($districts)
            ->addIndexColumn()
            ->addColumn('actions', function($row) {
                return '<div class="btn-group">
                            <button type="button" class="btn btn-soft-secondary btn-sm data-modal" data-url="' . route('districts.show', [$row->id]) . '"><i class="ri-eye-fill"></i></button>
                            <button type="button" class="btn btn-soft-secondary btn-sm data-modal" data-url="' . route('districts.edit', [$row->id]) . '"><i class="ri-pencil-fill"></i></button>
                            <a type="button" href="'.route('districts.delete',[$row->id]).'" data-confirm-delete="true" class="btn btn-danger btn-sm"><i class="ri-delete-bin-2-fill"></i></a>
                        </div>';
            })
            ->addColumn('name', function($row) {
                return ucwords($row->name);
            })
            ->addColumn('region', function($row) {
                return ucwords($row->region->name);
            })
            ->addColumn('created_at', function($row) {
                return Carbon::parse($row->created_at)->diffForHumans();
            })
            ->rawColumns(['name','region','actions'])
            ->make(true);
    }

}
