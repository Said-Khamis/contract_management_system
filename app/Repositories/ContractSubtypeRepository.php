<?php

namespace App\Repositories;

use App\Models\ContractSubtype;
use App\Repositories\BaseRepository;

/**
 * Class ContractSectorRepository
 * @package App\Repositories
 * @version June 3, 2023, 12:20 pm UTC
*/

class ContractSubtypeRepository extends BaseRepository
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
        return ContractSubtype::class;
    }

    public function getContractSubTypes()
    {
        return ContractSubtype::orderByDesc("created_at")->get();
    }
}
