<?php

namespace App\Services;

use App\Repositories\WardRepository;
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

class WardService
{
    public function __construct(
        protected WardRepository $wardRepository,
        protected DistrictService $districtService
    ){}


    public function findAll(): Collection | array
    {
        return $this->wardRepository->getWards();
    }

    /**
     * @throws Throwable
     */
    public function createWard(array $input): Model
    {
        return DB::transaction(function () use ($input){
            $district = $this->districtService->getDistrict($input['district_id']);
            if($district){
                return $this->wardRepository->createWithRelation($input, $district,'wards');
            }
            else{
                Alert::error(new ModelNotFoundException("District not found exception"));
                throw new ModelNotFoundException("District not found exception");
            }
        });
    }

    public function getWard($id): Model|Collection|Builder|array|null
    {
        return $this->wardRepository->find($id);
    }

    /**
     * @throws Throwable
     */
    public function updateWard(array $input, int $id): Model
    {
        return DB::transaction(function () use ($input,$id){
            return  $this->wardRepository->update($input,$id);
        });
    }

    /**
     * @throws Exception|Throwable
     */
    public function deleteWard(int $id): bool
    {
        return DB::transaction(function () use ($id){
            return  $this->wardRepository->delete($id);
        });
    }


    public function getWardsDataTable($wards):JsonResponse
    {
        return DataTables::of($wards)
            ->addIndexColumn()
            ->addColumn('actions', function($row) {
                return '<div class="btn-group">
                            <button type="button" class="btn btn-soft-secondary btn-sm data-modal" data-url="' . route('wards.show', [$row->id]) . '"><i class="ri-eye-fill"></i></button>
                            <button type="button" class="btn btn-soft-secondary btn-sm data-modal" data-url="' . route('wards.edit', [$row->id]) . '"><i class="ri-pencil-fill"></i></button>
                            <a type="button" href="'.route('wards.delete',[$row->id]).'" data-confirm-delete="true" class="btn btn-danger btn-sm"><i class="ri-delete-bin-2-fill"></i></a>
                        </div>';
            })
            ->addColumn('name', function($row) {
                return ucwords($row->name);
            })
            ->addColumn('district', function($row) {
                return ucwords($row->district->name);
            })
            ->addColumn('created_at', function($row) {
                return Carbon::parse($row->created_at)->diffForHumans();
            })
            ->rawColumns(['name','district','actions'])
            ->make(true);
    }

}
