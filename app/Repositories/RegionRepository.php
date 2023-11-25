<?php

namespace App\Repositories;

use App\Models\Region;
use Illuminate\Database\Eloquent\Collection;

/**
 * Class RegionRepository
 * @package App\Repositories
 * @version June 3, 2023, 12:01 pm UTC
*/

class RegionRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected array $fieldSearchable = [
        'name'
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
        return Region::class;
    }

    public function getRegions(): Collection
    {
        return Region::all();
    }
}
