<?php

namespace App\Services;

use App\Models\Region;
use App\Repositories\RegionRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Throwable;
use Yajra\DataTables\Facades\DataTables;

class RegionService
{

    public function __construct(
        protected RegionRepository $regionRepository,
        protected CountryService $countryService
    ){}

    public function findAll(): Collection | array
    {
        return $this->regionRepository->getRegions();
    }

    /**
     * @throws Throwable
     */
    public function createRegion(array $input): Model
    {
        return DB::transaction(function () use ($input){
            $country = $this->countryService->getCountry($input['country_id']);
            if($country){
                return $this->regionRepository->createWithRelation($input, $country,'regions');
            }
            else{
                Alert::error(new ModelNotFoundException("Country not found exception"));
                throw new ModelNotFoundException("Country not found exception");
            }
        });
    }

    /**
     * fetch one  region by its id
     * @param int $id id of primary key of a single region
     * @return Model|Collection|Builder|array|null a region instance of a model
     */
    public function getRegion(int $id): Model|Collection|Builder|array|null
    {
        return $this->regionRepository->find($id);
    }

    /**
     * Update region details
     * @param array $input new region input details to edit from region
     * @param int $id id of primary key of a region object we need to update
     * @return Model
     * @throws Throwable
     */
    public function updateRegion(array $input, int $id): Model
    {
        return DB::transaction(function () use($input,$id){
            return $this->regionRepository->update($input,$id);
        });
    }


    /**
     * delete a region from a database category table
     * @throws Exception|Throwable
     */
    public function deleteRegion(int $id): bool
    {
        return DB::transaction(function () use ($id){
            return $this->regionRepository->delete($id);
        });
    }

    public function getRegionsDataTable($regions): JsonResponse
    {
        return DataTables::of($regions)
            ->addIndexColumn()
            ->addColumn('actions', function($row) {
                return '<div class="btn-group">
                            <button type="button" class="btn btn-soft-secondary btn-sm data-modal" data-url="' . route('regions.show', [$row->id]) . '"><i class="ri-eye-fill"></i></button>
                            <button type="button" class="btn btn-soft-secondary btn-sm data-modal" data-url="' . route('regions.edit', [$row->id]) . '"><i class="ri-pencil-fill"></i></button>
                            <a type="button" href="'.route('regions.delete',[$row->id]).'" data-confirm-delete="true" class="btn btn-danger btn-sm"><i class="ri-delete-bin-2-fill"></i></a>
                        </div>';
            })
            ->addColumn('name', function($row) {
                return ucwords($row->name);
            })
            ->addColumn('country', function($row) {
                return ucwords($row->country->name);
            })
            ->addColumn('created_at', function($row) {
                return Carbon::parse($row->created_at)->diffForHumans();
            })
            ->rawColumns(['name','country','actions'])
            ->make(true);
    }

}
