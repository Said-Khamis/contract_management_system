<?php

namespace App\Services;

use App\Repositories\CityRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Yajra\DataTables\Facades\DataTables;

class CityService
{

    public function __construct(protected CityRepository $cityRepository, protected CountryService $countryService){}

      /**
     * creating new city
     * @param array $input new city input details to create from user
     * @return Model
     */
    public function createCity(array $input): Model
    {
        return DB::transaction(function () use ($input){
        $country = $this->countryService->getCountry($input['country_id']);
        if($country){
            return $this->cityRepository->createWithRelation($input, $country, 'cities');
        }
        else{
            Alert::error(new ModelNotFoundException("City not found exception"));
            throw new ModelNotFoundException("City not found exception");
        }
    });

    }

    /**
     * Update city details
     * @param array $input new city input details to edit from user
     * @param int $id id of primary key of a city object we need to update
     * @return Model|Collection|Builder|array
     * @throws \Throwable
     */
    public function updateCity(array $input,int $id): Model|Collection|Builder|array
    {
        return DB::transaction(function () use ($input, $id){
            return $this->cityRepository->update($input, $id);
        });
    }

     /**
     * delete a city from a database city table
     * @throws Exception
     */
    public function deleteCity(int $id)
    {
        return DB::transaction(function () use ($id){
        return $this->cityRepository->delete($id);
       });
    }

    /**
     * fetch one  city by its id
     * @param int $id id of primary key of a single city
     * @return Model|Collection|Builder|array|null a city instance of a model
     */
    public function getCity(int $id): Model|Collection|Builder|array|null
    {
        return $this->cityRepository->find($id);
    }

    /**
     * Fetch list of all cities in database
     * @return LengthAwarePaginator paginated results
     */
    public function findAll(): Collection | array
    {
        return $this->cityRepository->getCities();
    }

    public function getCountries(): Collection|array
    {
        return $this->countryService->findAll();
    }

    public function getCitiesDataTable($cities):JsonResponse
    {
        return DataTables::of($cities)
            ->addIndexColumn()
            ->addColumn('actions', function($row) {
                return '<div class="btn-group">
                            <button type="button" class="btn btn-soft-secondary btn-sm data-modal" data-url="' . route('cities.show', [$row->id]) . '"><i class="ri-eye-fill"></i></button>
                            <button type="button" class="btn btn-soft-secondary btn-sm data-modal" data-url="' . route('cities.edit', [$row->id]) . '"><i class="ri-pencil-fill"></i></button>
                            <a type="button" href="'.route('cities.delete',[$row->id]).'" data-confirm-delete="true" class="btn btn-danger btn-sm"><i class="ri-delete-bin-2-fill"></i></a>
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
