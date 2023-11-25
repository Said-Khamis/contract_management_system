<?php

namespace App\Repositories;

use App\Models\ContractResponsibility;
use App\Repositories\BaseRepository;

/**
 * Class ContractResponsibilityRepository
 * @package App\Repositories
 * @version June 3, 2023, 1:40 pm UTC
*/

class ContractResponsibilityRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'details',
        'contract_id',
        'party_id',
        'start_time',
        'end_time',
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
        return ContractResponsibility::class;
    }
}
