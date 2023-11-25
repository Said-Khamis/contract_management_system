<?php

namespace App\Services;

use App\Models\Country;
use App\Repositories\CountryRepository;
use Exception;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Throwable;

class CountryService
{
    public function __construct(protected CountryRepository $countryRepository){}

    /**
     * Fetch list of all country in database
     * @return Collection|Array
     */
    public function findAll(): Collection|Array
    {
        return $this->countryRepository->getCountries();
    }

    /**
     * creating new country
     * @param array $input user inputs
     * @throws Throwable
     */
    public function createCountry(array $input): Model
    {
        $check=$input['flexRadioDefault'];
        if($check==1)
        {
            $newInput=[
                'name'=>$input['name'],
                'code'=>$input['code'],
                'hasRegion'=>1
            ];
        }else if($check==2)
        {
            $newInput=[
                'name'=>$input['name'],
                'code'=>$input['code'],
                'hasState'=>1
            ];
        }else
        {
            $newInput=[
                'name'=>$input['name'],
                'code'=>$input['code'],
                'hasCity'=>1
            ];
        }
        return DB::transaction(function () use ($newInput){
            return $this->countryRepository->create($newInput);
        });
    }

    /**
     * fetch one  country by its id
     * @param int $id id of primary key of a single country
     * @return Model|Collection|Builder|array|null a country instance of a model
     */
    public function getCountry(int $id): Model|Collection|Builder|array|null
    {
        return $this->countryRepository->find($id);
    }

    /**
     * Update country details
     * @param array $input new country input details to edit from country
     * @param int $id id of primary key of a country object we need to update
     * @return Model
     * @throws Throwable
     */
    public function updateCountry(array $input, int $id): Model
    {
        $check=$input['flexRadioDefault'];
        Country::find($id)->update([
                'hasRegion'=>0,
                'hasState'=>0,
                'hasCity'=>0
        ]);
        if($check==1)
        {
            $newInput=[
                'name'=>$input['name'],
                'code'=>$input['code'],
                'hasRegion'=>1
            ];
        }else if($check==2)
        {
            $newInput=[
                'name'=>$input['name'],
                'code'=>$input['code'],
                'hasState'=>1
            ];
        }else
        {
            $newInput=[
                'name'=>$input['name'],
                'code'=>$input['code'],
                'hasCity'=>1
            ];
        }
        return DB::transaction(function () use ($newInput,$id){
            return $this->countryRepository->update($newInput,$id);
        });
    }

    /**
     * delete a country from a database category table
     *
     * @throws Exception
     * @throws Throwable
     */
    public function deleteCountry(int $id): bool
    {
        return DB::transaction(function () use ($id){
            return $this->countryRepository->delete($id);
        });
    }

}
