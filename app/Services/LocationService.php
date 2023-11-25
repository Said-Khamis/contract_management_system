<?php

namespace App\Services;

use App\Repositories\LocationRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Throwable;

class LocationService
{

    public function __construct(
        protected LocationRepository $locationRepository
    ){}

    /**
     * @param array $input
     * @return Model
     * @throws Throwable
     */
    public function createLocationWithInputs(array $input): Model
    {
        return DB::transaction(function() use($input){
            return $this->locationRepository->create($input);
        });
    }

    /**
     * @param Model $model
     * @param array $input
     * @param string $relation
     * @return Model
     * @throws Throwable
     */
    public function createLocation(Model $model, array $input, string $relation): Model
    {
        return DB::transaction(function() use ($model, $input, $relation){
            return $this->locationRepository->createWithRelation($input, $model, $relation);
        });
    }

    /**
     * @param array $input
     * @return array
     */
    public function setLocationInputs(array $input): array
    {
        $locationInput = [
            'country_id' => $input['country_id'],
            //'settlement' => $input['settlement']
        ];

        if(isset($input['region_id']))
            $locationInput['region_id'] = $input['region_id'];

        if(isset($input['city_id']))
            $locationInput['city_id'] = $input['city_id'];

        if(isset($input['state_id']))
            $locationInput['state_id'] = $input['state_id'];

        if(isset($input['district_id']))
            $locationInput['district_id'] = $input['district_id'];

        if(isset($input['ward_id']))
            $locationInput['ward_id'] = $input['ward_id'];

        return $locationInput;
    }
}
