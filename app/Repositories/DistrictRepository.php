<?php

namespace App\Repositories;

use App\Models\District;
use App\Repositories\BaseRepository;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class DistrictRepository
 * @package App\Repositories
 * @version June 3, 2023, 12:11 pm UTC
*/

class DistrictRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected array $fieldSearchable = [
        'name',
        'created_by',
        'updated_by',
        'region_id'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model(): string
    {
        return District::class;
    }

    public function getDistricts(): Collection
    {
        return District::all();
    }
}
