<?php

namespace App\Repositories;

use App\Models\ContractParty;
use App\Repositories\BaseRepository;

/**
 * Class ContractPartyRepository
 * @package App\Repositories
 * @version June 3, 2023, 1:00 pm UTC
*/

class ContractPartyRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'name',
        'is_main',
        'is_home',
        'location_id',
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
        return ContractParty::class;
    }
}
