<?php

namespace App\Repositories;

use App\Models\ContractResponsibilityStatus;
use App\Repositories\BaseRepository;

/**
 * Class ContractResponsibilityStatusRepository
 * @package App\Repositories
 * @version June 3, 2023, 1:46 pm UTC
*/

class ContractResponsibilityStatusRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'contract_responsibility_id',
        'status',
        'comment',
        'status_updated_at',
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
        return ContractResponsibilityStatus::class;
    }
}
