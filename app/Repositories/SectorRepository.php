<?php

namespace App\Repositories;

use App\Models\Sector;
use App\Repositories\BaseRepository;

/**
 * Class ContractSectorRepository
 * @package App\Repositories
 * @version June 3, 2023, 12:20 pm UTC
*/

class SectorRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'created_by',
        'updated_by'
    ];

    /**
     * Return searchable fields
     *
     * @return array
     */
    public function getFieldsSearchable()
    {
        return $this->fieldSearchable;
    }

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Sector::class;
    }

    public function getSectors()
    {
        return Sector::orderByDesc("created_at")->get();
    }
}
